<?php

namespace App\Http\Controllers\Backend;

use App\Department;
use App\Order;
use App\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{
    public function __construct()
    {
        view()->composer('backend.users._form',function($view){
            $view->with([
                'roles'=>Role::pluck('name')->all(),
                'departments'=>Department::get()
                ]);
        });
        parent::__construct();
    }

    public function index()
    {
        $list = User::all();
        return view('backend.users.index',compact('list'));
    }

    public function create()
    {
        $user = new User;
        return view('backend.users.create',compact('user'));
    }

    public function store(UserRequest $request)
    {
        $input = $request->except('_token');
        $user = User::create($input);
        if($input['role']) {
            $user->syncRoles($input['role']);
        }
        return redirect()->route('backend.users.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(User $user)
    {
        return view('backend.users.edit',compact('user'));
    }

    public function update(UserRequest $request,User $user)
    {
        $input = $request->except('_token','_method');
        if(!empty($input['password'])){
            $user->preventAttrSet = false;
            $input['password'] = $input['password'];
        }else{
            $user->preventAttrSet = true;
            $input['password'] = $user->password;
        }
        $user->update($input);
        if($input['role']){
            $user->syncRoles($input['role']);
        }
        return redirect()->route('backend.users.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(User $user){
        return $user->delete();
    }


    public function getPersonInvoices(){
        $personid = request('id');
        $orders = Order::where('client_id',$personid)->get();
        $options = "";
        foreach ($orders as $ord){
            $options .= '<option value="'.$ord->id.'"> طلب رقم ('.$ord->id.') رقم العقد '.$ord->contract_number.'</option>';
        }
        return json_encode([
            'list'=>$options
        ]);

    }
}
