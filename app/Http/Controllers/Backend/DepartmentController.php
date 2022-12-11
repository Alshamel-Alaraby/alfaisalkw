<?php

namespace App\Http\Controllers\Backend;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends BaseController
{

    public function index()
    {
        $list = Department::all();
        return view('backend.departments.index',compact('list'));
    }

    public function create()
    {
        $department = new Department;
        if(\request()->ajax()){
            return view('backend.departments.ajax',compact('department'));
        }
        return view('backend.departments.create',compact('department'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $department = Department::create($input);
        return redirect()->route('backend.departments.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(Department $department)
    {
        return view('backend.departments.edit',compact('department'));
    }

    public function update(Request $request,Department $department)
    {
        $input = $request->except('_token','_method');
        $department->update($input);
        return redirect()->route('backend.departments.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(Department $department){
        return $department->delete();
    }
}
