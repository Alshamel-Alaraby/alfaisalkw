<?php

namespace App\Http\Controllers\Backend;

use App\Requests\BuffetCategoryRequest;
use App\BuffetCategory;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class BuffetCategoryController extends BaseController
{

    public function index()
    {
        $list = BuffetCategory::all();
        return view('backend.buffetcategory.index',compact('list'));
    }

    public function create()
    {
        $buffetcategory = new BuffetCategory;
        return view('backend.buffetcategory.create',compact('buffetcategory'));
    }

    public function store(BuffetCategoryRequest $request)
    {
        $input = $request->except('_token');
        $input['show_in_home'] = request()->has('show_in_home');
        $category = BuffetCategory::create($input);
        if ($request->file('image')) {
            $category->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return redirect()->route('backend.buffetcategory.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(BuffetCategory $buffetcategory)
    {
        return view('backend.buffetcategory.edit',compact('buffetcategory'));
    }

    public function update(BuffetCategoryRequest $request,BuffetCategory $buffetcategory)
    {
        $input = $request->except('_token','_method');
        $input['show_in_home'] = request()->has('show_in_home');
        $buffetcategory->update($input);
        if ($request->file('image')) {
            $buffetcategory->clearMediaCollection('images');
            $buffetcategory->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return redirect()->route('backend.buffetcategory.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(BuffetCategory $buffetcategory){
        return $buffetcategory->delete();
    }
}
