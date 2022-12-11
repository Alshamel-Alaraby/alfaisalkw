<?php

namespace App\Http\Controllers;

use App\Buffet;
use App\BuffetCategory;
use App\Category;
use App\Item;
use App\Slider;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function show()
    {
        return view('products.show');
    }

    public function list()
    {
        $list=Item::orderBy('category_id')->where('is_visible',1)->get();
        $products=$list->where('type','products');
        $decors=$list->where('type','decor');
        $buffets = Buffet::get();
        return view('products.list',compact('products','decors','buffets'));
    }

}
