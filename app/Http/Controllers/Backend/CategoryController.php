<?php

namespace App\Http\Controllers\Backend;

use App\Requests\CategoryRequest;
use App\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CategoryController extends BaseController
{

    public function __construct()
    {
        view()->composer('backend.category._form',function($view){
            $view->with([
                'categoryList'=>Category::all()
            ]);
        });
        parent::__construct();
    }

    public function index()
    {
        $list = Category::all()->toTree();
        return view('backend.category.index',compact('list'));
    }

    public function create()
    {
        $category = new Category;
        return view('backend.category.create',compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        $input = $request->except('_token');
        $input['show_in_home'] = request()->has('show_in_home');
        $category = Category::create($input);
        if ($request->file('image')) {
            $category->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return redirect()->route('backend.category.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(Category $category)
    {
        return view('backend.category.edit',compact('category'));
    }

    public function update(CategoryRequest $request,Category $category)
    {
        $input = $request->except('_token','_method');
        $input['show_in_home'] = request()->has('show_in_home');
        $category->update($input);
        if ($request->file('image')) {
            $category->clearMediaCollection('images');
            $category->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return redirect()->route('backend.category.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(Category $category){
        return $category->delete();
    }
}
