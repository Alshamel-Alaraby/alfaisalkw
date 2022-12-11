<?php

namespace App\Http\Controllers\Backend;

use App\Requests\PageRequest;
use App\Page;
use Illuminate\Http\Request;

class PageController extends BaseController
{

    public function index()
    {
        $list = Page::all();
        return view('backend.pages.index',compact('list'));
    }

    public function create()
    {
        $page = new Page;
        return view('backend.pages.create',compact('page'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $page = Page::create($input);
        if ($request->file('image')) {
            $page->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return redirect()->route('backend.pages.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(Page $page)
    {
        return view('backend.pages.edit',compact('page'));
    }

    public function update(Request $request,Page $page)
    {
        $input = $request->except('_token','_method');
        $page->update($input);
        if ($request->file('image')) {
            $page->clearMediaCollection('images');
            $page->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return redirect()->route('backend.pages.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(Page $page){
        return $page->delete();
    }
}
