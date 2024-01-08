<?php

namespace App\Http\Controllers\Backend;

use App\Requests\PaymentRequest;
use App\Payment;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PaymentController extends BaseController
{

    public function index()
    {
        $list = Payment::all();
        return view('backend.payments.index',compact('list'));
    }

    public function create()
    {
        $payment = new Payment;

        return view('backend.payments.create',compact('payment'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $payment = Payment::create($input);
        if(request()->ajax()=='ajax'){
            $payments = Payment::get();
            return view('backend.payments.dropdown',compact('payments'));
        }
        return redirect()->route('backend.payments.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(Payment $payment)
    {
        return view('backend.payments.edit',compact('payment'));
    }

    public function update(Request $request,Payment $payment)
    {
        $input = $request->except('_token','_method');
        $payment->update($input);
        return redirect()->route('backend.payments.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(Payment $payment){
        return $payment->delete();
    }
}
