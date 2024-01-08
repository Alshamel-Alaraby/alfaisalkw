<?php

namespace App\Http\Controllers\Backend;

use App\Buffet;
use App\Client;
use App\Department;
use App\Enum\Status;
use App\Events\OrderStatusChanged;
use App\Item;
use App\Order;
use App\OrderTask;
use App\Requests\OrderRequest;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{

    public function __construct()
    {
        $list = Item::get();
        view()->composer('backend.orders._form', function ($view) use ($list) {
            $view->with([
                'clients' => Client::get(),
                'products' => $list->where('type', 'products'),
                'equipments' => $list->where('type', 'equipments'),
                'decors' => $list->where('type', 'decor'),
                'buffets' => Buffet::get(),
                'statuses' => Status::toArray(),
                'users' => User::get(),
            ]);
        });
        parent::__construct();
    }

    public function index()
    {
        $loggedInUserId = auth()->id();
        $roleIds = [1, 12];

        $userRoles = DB::table('model_has_roles')
            ->where('model_type', 'App\\User')
            ->where('model_id', $loggedInUserId)
            ->whereIn('role_id', $roleIds)
            ->count();

        if ($userRoles > 0) {

            $list = Order::filter()->paginate(50);//->get();
            return view('backend.orders.index', compact('list'));

        } else {

            $list = Order::filter()->where('delegator_id', $loggedInUserId)->paginate(50);//->get();
            return view('backend.orders.index', compact('list'));

        }
    }
    public function create()
    {
        $order = new Order;
        return view('backend.orders.create', compact('order'));
    }

    public function store(OrderRequest $request)
    {

        try {
            DB::beginTransaction();
            $input = $request->except('_token');
            $input['contract_number'] = str_replace(['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'], ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], $input['contract_number']);

            foreach ($input['detail'] as $item) {
                $itm = Item::query()->where('type', 'decor')->find($item['item_id']);
                if ($itm && $item['qty'] && $itm->availableQty($input['day']) < $item['qty']) {
                    throw new \Exception("الكمية المطلوبة من $itm->name لا تكفي");
                }
            }
            $order = Order::create($input);
            $order->details()->attach($input['detail']);
            $order->setStatus(request('status'), request('comment'));

            if ($request->payments) {
                foreach ($request->payments as $payment) {
                    $order->payments()->create($payment);
                }
            }
            if ($request->addition_amounts) {
                foreach ($request->addition_amounts as $addition_amount) {
                    $order->additions()->create($addition_amount);
                }
            }
            if ($request->discount_amounts) {
                foreach ($request->discount_amounts as $discount_amount) {
                    $order->discounts()->create($discount_amount);
                }
            }

            $discount = @$order->discounts()->sum('value') ?: 0;
            $addition = @$order->additions()->sum('value') ?: 0;
            $payment = @$order->payments()->sum('value') ?: 0;
            $order->discount = $discount;
            $order->addition = $addition;
            $order->final_total = $order->total + $order->addition;
            $order->due = $order->total + $addition - $discount - $order->paid - $payment;
            $order->save();

            event(new OrderStatusChanged($order));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $error = json_decode($e->getMessage()) ?: $e->getMessage();
            return redirect()->back()->withInput()->withErrors($error);
        }
        return redirect()->route('backend.orders.index')->with('alert-success', 'تمت الإضافة بنجاح');
    }

    public function edit(Order $order)
    {
        $selectedBuffet = $order->buffet;
        $list = $order->details;
        $selectedProd = $list->where('type', 'products');
        $selectedEq = $list->where('type', 'equipments');
        $selectedDocor = $list->where('type', 'decor');
        return view('backend.orders.edit', compact('order', 'selectedProd', 'selectedEq', 'selectedDocor', 'selectedBuffet'));
    }

    public function update(OrderRequest $request, Order $order)
    {

        try {
            DB::beginTransaction();
            $input = $request->except('_token', '_method');
            $oldStatus = $order->status;
            $order->update($input);

            foreach ($order->details as $item) {
                if (!$item->observe_qty) {
                    continue;
                }

                if ($item->pivot->is_sub == 1) {
                    $item->qty += $item->pivot->qty;
                    $item->save();
                }
            }
            $order->details()->detach();
            $order->details()->attach($input['detail']);
            if ($oldStatus != request('status')) {
                $order->setStatus(request('status'), request('comment'));
            }

            $order->payments()->delete();
            $order->additions()->delete();
            $order->discounts()->delete();

            if ($request->payments) {
                foreach ($request->payments as $payment) {
                    $order->payments()->create($payment);
                }
            }
            if ($request->addition_amounts) {
                foreach ($request->addition_amounts as $addition_amount) {
                    $order->additions()->create($addition_amount);
                }
            }
            if ($request->discount_amounts) {
                foreach ($request->discount_amounts as $discount_amount) {
                    $order->discounts()->create($discount_amount);
                }
            }

            $discount = @$order->discounts()->sum('value') ?: 0;
            $addition = @$order->additions()->sum('value') ?: 0;
            $payment = @$order->payments()->sum('value') ?: 0;
            $order->discount = $discount;
            $order->addition = $addition;
            $order->final_total = $order->total + $order->addition;
            $order->due = $order->total + $addition - $discount - $order->paid - $payment;
            $order->save();

            event(new OrderStatusChanged($order));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $error = json_decode($e->getMessage()) ?: $e->getMessage();
            return redirect()->back()->withInput()->withErrors($error);
        }
        return redirect()->route('backend.orders.index')->with('alert-success', 'تم التعديل بنجاح');
    }

    public function show(Order $order)
    {
        $list = $order->details;
        $selectedProd = $list->where('type', 'products');
        $selectedEq = $list->where('type', 'equipments');
        $selectedDocor = $list->where('type', 'decor');
        $selectedBuffet = $order->buffet;
        $departments = Department::get();
        $users = User::get();
        $tasks = Task::get();

        $orderTasks = $order->orderTask();
        if (auth()->user()->roles[0]->name != "Admin") {
            $list->where(function ($query) {
                $query->whereNull('user_id');
                $query->where('department_id', auth()->user()->department_id);
            })->orwhere(function ($query) {
                $query->where('user_id', auth()->user()->id);
                $query->where('department_id', auth()->user()->department_id);
            });
        }
        $orderTasks = $orderTasks->get();
        return view('backend.orders.show', compact('order', 'selectedProd', 'selectedEq',
            'selectedDocor', 'selectedBuffet', 'departments', 'tasks', 'users', 'orderTasks'));
    }

    public function destroy(Order $order)
    {
        return $order->delete();
    }

    public function changeStatus(Order $order)
    {
        if (request()->isMethod('POST')) {
            try {
                DB::beginTransaction();
                $oldStatus = $order->status;
                if ($oldStatus != request('status')) {
                    $order->setStatus(request('status'), request('comment'));
                    event(new OrderStatusChanged($order));
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $error = json_decode($e->getMessage()) ?: $e->getMessage();
                return back()->withErrors($error);
            }
            return back()->with('alert-success', 'Order Status has been updated successfully');
        }
        $statuses = Status::toArray();
        return view('backend.orders.change_status', compact('order', 'statuses'));
    }
    public function assignTask(Order $order)
    {
        if (request()->isMethod('POST')) {
            try {
                DB::beginTransaction();
                $inputs = \request()->except('_token');
                $inputs['order_id'] = $order->id;
                OrderTask::create($inputs);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $error = json_decode($e->getMessage()) ?: $e->getMessage();
                return back()->withErrors($error);
            }
            return back()->with('alert-success', 'تمت الإضافة بنجاح');
        }

        $orderTasks = $order->orderTask();
        if (auth()->user()->roles[0]->name != "Admin") {
            $list->where(function ($query) {
                $query->whereNull('user_id');
                $query->where('department_id', auth()->user()->department_id);
            })->orwhere(function ($query) {
                $query->where('user_id', auth()->user()->id);
                $query->where('department_id', auth()->user()->department_id);
            });
        }
        $orderTasks = $orderTasks->get();
        $departments = Department::get();
        $users = User::get();
        $tasks = Task::get();
        return view('backend.orders.assign_task', compact('order', 'departments', 'tasks', 'users', 'orderTasks'));
    }
}
