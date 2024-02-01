<?php

namespace App\Http\Controllers\Backend;

use App\Buffet;
use App\Client;
use App\Department;
use App\Enum\Status;
use App\Item;
use App\Order;
use App\Payment;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{

    // public function index()
    // {
    //     $list = Payment::all();
    //     return view('backend.payments.index_new',compact('list'));
    // }

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

        $list = Order::filter()->paginate(50); //->get();
        return view('backend.payments.index_new', compact('list'));
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
        return view('backend.payments.show', compact('order', 'selectedProd', 'selectedEq',
            'selectedDocor', 'selectedBuffet', 'departments', 'tasks', 'users', 'orderTasks'));
    }




    public function create()
    {
        $payment = new Payment;

        return view('backend.payments.create', compact('payment'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $payment = Payment::create($input);
        if (request()->ajax() == 'ajax') {
            $payments = Payment::get();
            return view('backend.payments.dropdown', compact('payments'));
        }
        return redirect()->route('backend.payments.index')->with('alert-success', 'تمت الإضافة بنجاح');
    }

    public function edit(Payment $payment)
    {
        return view('backend.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $input = $request->except('_token', '_method');
        $payment->update($input);
        return redirect()->route('backend.payments.index')->with('alert-success', 'تم التعديل بنجاح');
    }

    public function destroy(Payment $payment)
    {
        return $payment->delete();
    }
}
