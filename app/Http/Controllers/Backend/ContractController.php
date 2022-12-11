<?php

namespace App\Http\Controllers\Backend;

use App\Requests\ContractRequest;
use App\Contract;

class ContractController extends BaseController
{

    public function index()
    {
        $list = Contract::all();
        return view('backend.contracts.index',compact('list'));
    }

    public function create()
    {
        $contract = new Contract;
        return view('backend.contracts.create',compact('contract'));
    }

    public function store(ContractRequest $request)
    {
        $input = $request->except('_token');
        $contract = Contract::create($input);
        return redirect()->route('backend.contracts.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(Contract $contract)
    {
        return view('backend.contracts.edit',compact('contract'));
    }

    public function update(ContractRequest $request,Contract $contract)
    {
        $input = $request->except('_token','_method');
        $contract->update($input);
        return redirect()->route('backend.contracts.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(Contract $contract){
        return $contract->delete();
    }
}
