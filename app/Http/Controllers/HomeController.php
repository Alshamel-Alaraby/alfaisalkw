<?php

namespace App\Http\Controllers;

use App\Buffet;
use App\BuffetCategory;
use App\Category;
use App\Gallery;
use App\Item;
use App\Page;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Artisan;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*Artisan::call('migrate');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        dd("done");*/
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::get();
        $buffetList = BuffetCategory::where('show_in_home',1)->take(3)->get();
        $gallery = Gallery::where('show_in_home',1)->take(6)->get();
        return view('home',compact('sliders', 'gallery','buffetList'));
    }

    public function getPage($slug)
    {
        $page = Page::where('slug',$slug)->first();
        return view('page',compact('page'));
    }

    public function getBuffet($category_id)
    {
        $list = Buffet::where('category_id',$category_id)->get();
        $category = BuffetCategory::find($category_id);
        return view('products.buffets',compact('list','category'));
    }
    public function getBuffetDetails($b_id)
    {
        $buffet = Buffet::find($b_id);
        $list = $buffet->visibledetails;
        return view('products.buffet_details',compact('buffet','list'));
    }

    public function product($id){
        $item = Item::find($id);
        return view('products.show',compact('item'));
    }

    public function contact(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->only('name','email', 'mobile','comment');
            $this->validate(request(), [
                'name' => 'required|max:20',
                'email' => 'required|email',
                'mobile' => 'required',
                'comment' => 'required',
            ]);
            try{
                $sub = 'Contact Us';
                Mail::send('emails.contact', $data, function ($msg) use ($sub) {
                    $msg->subject($sub);
                    $msg->to(['info@alfaisalkw.com']);
                });
            }catch (\Exception $e){
                //dd($e->getMessage());
                return back()->with('alert-error','error occured pleasy try again later');
            }
            return back()->with('alert-success',trans('tr.Your request has been sent successfully.'));
        }
        return view('contact');
    }

}
