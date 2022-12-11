<?php

namespace App\Http\Controllers\Backend;

use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends BaseController
{

    public function index()
    {
        $list = Gallery::all();
        return view('backend.gallery.index',compact('list'));
    }

    public function create()
    {
        $gallery = new Gallery;
        return view('backend.gallery.create',compact('gallery'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $input['show_in_home'] = request()->has('show_in_home');
        $gallery = Gallery::create($input);
        if ($request->file('image')) {
            $gallery->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return redirect()->route('backend.gallery.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(Gallery $gallery)
    {
        return view('backend.gallery.edit',compact('gallery'));
    }

    public function update(Request $request,Gallery $gallery)
    {
        $input = $request->except('_token','_method');
        $input['show_in_home'] = request()->has('show_in_home');
        $gallery->update($input);
        if ($request->file('image')) {
            $gallery->clearMediaCollection('images');
            $gallery->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return redirect()->route('backend.gallery.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(Gallery $gallery){
        return $gallery->delete();
    }
}
