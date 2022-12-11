<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Requests\ItemRequest;
use App\Item;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Models\Role;

class ItemController extends BaseController
{

    public function __construct()
    {
        view()->composer('backend.items._form',function($view){
            $view->with([
                'categoryList'=>Category::all()
            ]);
        });
        parent::__construct();
    }

    public function index()
    {
        $list = Item::all();
        return view('backend.items.index',compact('list'));
    }

    public function create()
    {
        $item = new Item;
        return view('backend.items.create',compact('item'));
    }

    public function store(ItemRequest $request)
    {
        $input = $request->except('_token');
        $input['has_price'] = $request->has('has_price');
        $input['has_qty'] = $request->has('has_qty');
        $input['observe_qty'] = $request->has('observe_qty');
        $input['is_visible'] = $request->has('is_visible');

        $item = Item::create($input);
        if ($request->file('image')) {
            $item->addMedia($request->file('image'))->toMediaCollection('images');
        }
        if ($request->file('extraimages')) {
            foreach($request->file('extraimages') as $img){
                $item->addMedia($img)->toMediaCollection('extraimages');
            }
        }
        return redirect()->route('backend.items.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(Item $item)
    {
        return view('backend.items.edit',compact('item'));
    }

    public function update(ItemRequest $request,Item $item)
    {
        $input = $request->except('_token','_method');
        $input['has_price'] = $request->has('has_price');
        $input['has_qty'] = $request->has('has_qty');
        $input['observe_qty'] = $request->has('observe_qty');
        $input['is_visible'] = $request->has('is_visible');
        $item->update($input);
        if(isset($input['mediaTodelete'])){
            Media::whereIn('id', $input['mediaTodelete'])->delete();
        }
        if ($request->file('image')) {
            $item->clearMediaCollection('images');
            $item->addMedia($request->file('image'))->toMediaCollection('images');
        }
        if ($request->file('extraimages')) {
            foreach($request->file('extraimages') as $img){
                $item->addMedia($img)->toMediaCollection('extraimages');
            }
        }
        return redirect()->route('backend.items.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function destroy(Item $item){
        return $item->delete();
    }
}
