<?php
namespace App\Http\Controllers\Backend;

use App\Common\Support\PermissionsTrait;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Arr;

class RoleController extends BaseController
{
    use PermissionsTrait;

    public function __construct()
    {
        view()->composer('backend.roles._form',function($view){
            $view->with('permissions',Arr::pluck($this->getPermissions(),'permission'));

        });

        $this->updatePermissionsTable();

        parent::__construct();
    }

    public function index()
    {
        $list = Role::latest()->paginate();

        return view('backend.roles.index', compact('list'));
    }

    public function create()
    {
        return view('backend.roles.create', ['role' => new Role()]);
    }

    public function store(Request $request)
    {
        $this->validate($request,$this->getRoles());
        $name = $request->get('name');
        $role = Role::create(['name' => $name]);
        if($request->has('permissions')){
            $role->syncPermissions($request->get('permissions'));
        }
        return redirect()->route('backend.roles.index')->with('alert-success',"Record saved successfully");;
    }

    public function edit($id)
    {
        return view('backend.roles.edit', ['role' => Role::findOrFail($id)]);
    }

    public function update($id, Request $request)
    {
        $role = Role::findOrFail($id);
        $this->validate($request,$this->getRoles($role->id));
        $name = $request->get('name');
        $role->fill(['name' => $name])->save();
        if($request->has('permissions')){
            $role->syncPermissions($request->get('permissions'));
        }
        return redirect()->route('backend.roles.index')->with('alert-success',"Record saved successfully");;
    }

    public function destroy($id)
    {
        return Role::destroy($id);
    }

    public function getRoles($id=NULL)
    {
        return [
            'name'=>  $id ? 'required|unique:roles,name,'.$id : 'required|unique:roles' ,

            'permissions.*'=>'required|in:'.implode(',', Arr::pluck($this->getPermissions(),'permission'))

        ];
    }

}
