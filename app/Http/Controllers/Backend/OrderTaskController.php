<?php

namespace App\Http\Controllers\Backend;

use App\Department;
use App\OrderTask;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class OrderTaskController extends BaseController
{
    public function __construct()
    {
        view()->composer('backend.order_task.edit',function($view){
            $view->with([
                'departments'=>Department::get(),
                'users'=>User::get(),
                'tasks'=>Task::get()
            ]);
        });
        parent::__construct();
    }
    public function index()
    {
        $list = OrderTask::query();
        if(auth()->user()->roles[0]->name!="Admin"){
            $list->where(function($query){
                $query->whereNull('user_id');
                $query->where('department_id',auth()->user()->department_id);
            })->orwhere(function($query){
                $query->where('user_id',auth()->user()->id);
                $query->where('department_id',auth()->user()->department_id);
            });
        }
        $list = $list->latest()->get();
        return view('backend.order_task.index',compact('list'));
    }

    public function edit(OrderTask $ordertask)
    {
        $order = $ordertask->order;
        $list = $order->details;
        $selectedProd = $list->where('type','products');
        $selectedEq = $list->where('type','equipments');
        $selectedDocor = $list->where('type','decor');
        $selectedBuffet = $order->buffet;
        return view('backend.order_task.edit',compact('ordertask','order','selectedProd','selectedEq',
            'selectedDocor','selectedBuffet'));
    }

    public function update(Request $request,OrderTask $ordertask)
    {
        $input = $request->except('_token','_method');
        $ordertask->update($input);
        return redirect()->route('backend.ordertasks.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(OrderTask $ordertask){
        return $ordertask->delete();
    }
}
