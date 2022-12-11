<?php

namespace App\Http\Controllers;

use App\Client;
use App\Department;
use App\Order;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(Request $request)
    {
        $user = auth('web')->user();
        if($request->isMethod('post')){
            $inputs = $request->except('_token');
            $inputs['password'] = $inputs['password']?bcrypt($inputs['password']):$user->password;
            $user->preventAttrSet = true;
            $user->update($inputs);
            return back()->with('alert-success',trans('tr.Your Account has been updated successfuly'));
        }
        return view('account.profile',compact('user'));
    }

    public function orders()
    {
        $orders = auth('web')->user()->orders;
        return view('account.orders',compact('orders'));
    }

    public function detailes($id)
    {
        $order = Order::findorFail($id);
        $list = $order->details;
        $selectedProd = $list->where('type','products');
        $selectedEq = $list->where('type','equipments');
        $selectedDocor = $list->where('type','decor');
        $selectedBuffet = $order->buffet;
        return view('account.detail',compact('order','selectedProd',
            'selectedEq','selectedDocor','selectedBuffet'));
    }


}
