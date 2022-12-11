<?php

namespace App\Http\Controllers\Backend;

use App\BuffetCategory;
use App\Item;
use App\Requests\BuffetRequest;
use App\Buffet;
use Illuminate\Support\Facades\DB;

class BuffetController extends BaseController
{

    public function __construct()
    {
        $list=Item::get();
        view()->composer('backend.buffets._form',function($view) use($list){
            $view->with([
                'categoryList'=>BuffetCategory::get(),
                'products'=>$list->where('type','products'),
                'equipments'=>$list->where('type','equipments'),
                'decors'=>$list->where('type','decor')
            ]);
        });
        parent::__construct();
    }

    public function index()
    {
        $list = Buffet::latest()->get();
        return view('backend.buffets.index',compact('list'));
    }

    public function create()
    {
        $buffet = new Buffet;
        return view('backend.buffets.create',compact('buffet'));
    }

    public function store(BuffetRequest $request)
    {
        try{
            DB::beginTransaction();
            $input = $request->except('_token');
            $buffet = Buffet::create($input);
            $buffet->details()->attach($input['detail']);
            if ($request->file('image')) {
                $buffet->addMedia($request->file('image'))->toMediaCollection('images');
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            $error = json_decode($e->getMessage())?:$e->getMessage();
            return back()->withErrors($error);
        }
        return redirect()->route('backend.buffets.index')->with('alert-success','تمت الإضافة بنجاح');
    }

    public function edit(Buffet $buffet)
    {
        $list = $buffet->details;
        $selectedProd = $list->where('type','products');
        $selectedEq = $list->where('type','equipments');
        $selectedDocor = $list->where('type','decor');
        return view('backend.buffets.edit',compact('buffet','selectedProd','selectedEq','selectedDocor'));
    }

    public function update(BuffetRequest $request,Buffet $buffet)
    {
        try{
            DB::beginTransaction();
            $input = $request->except('_token','_method');
            $buffet->update($input);
            $buffet->details()->detach();
            $buffet->details()->attach($input['detail']);
            if ($request->file('image')) {
                $buffet->clearMediaCollection('images');
                $buffet->addMedia($request->file('image'))->toMediaCollection('images');
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            $error = json_decode($e->getMessage())?:$e->getMessage();
            return back()->withErrors($error);
        }
        return redirect()->route('backend.buffets.index')->with('alert-success','تم التعديل بنجاح');
    }

    public function show(Buffet $buffet)
    {
        return view('backend.buffets.show',compact('buffet'));
    }

    public function destroy(Buffet $buffet){
        return $buffet->delete();
    }
}
