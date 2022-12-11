<?php

namespace App\Http\Controllers\Backend;

use App\Requests\SliderRequest;
use App\Slider;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SliderController extends BaseController
{

    public function index()
    {
        $list = Slider::all();
        return view('backend.sliders.index',compact('list'));
    }

    public function create()
    {
        $slider = new Slider;
        return view('backend.sliders.create',compact('slider'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $category = Slider::create($input);
        if ($request->file('image')) {
            $category->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return redirect()->route('backend.sliders.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(Slider $slider)
    {
        return view('backend.sliders.edit',compact('slider'));
    }

    public function update(Request $request,Slider $slider)
    {
        $input = $request->except('_token','_method');
        $slider->update($input);
        if ($request->file('image')) {
            $slider->clearMediaCollection('images');
            $slider->addMedia($request->file('image'))->toMediaCollection('images');
        }
        return redirect()->route('backend.sliders.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(Slider $slider){
        return $slider->delete();
    }
}
