<?php

namespace App\Http\Controllers\Backend;

use App\Requests\ClientRequest;
use App\Client;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ClientController extends BaseController
{

    public function index()
    {
        $list = Client::all();
        return view('backend.clients.index',compact('list'));
    }

    public function create()
    {
        $client = new Client;
        if(\request()->ajax()){
            return view('backend.clients.ajax',compact('client'));
        }
        return view('backend.clients.create',compact('client'));
    }

    public function store(ClientRequest $request)
    {
        $input = $request->except('_token');
        $client = Client::create($input);
        if(request()->ajax()=='ajax'){
            $clients = Client::get();
            return view('backend.clients.dropdown',compact('clients'));
        }
        return redirect()->route('backend.clients.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(Client $client)
    {
        return view('backend.clients.edit',compact('client'));
    }

    public function update(ClientRequest $request,Client $client)
    {
        $input = $request->except('_token','_method');
        $client->update($input);
        return redirect()->route('backend.clients.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(Client $client){
        return $client->delete();
    }
}
