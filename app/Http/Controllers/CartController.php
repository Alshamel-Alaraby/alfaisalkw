<?php

namespace App\Http\Controllers;

use App\Buffet;
use App\Enum\Status;
use App\Events\OrderStatusChanged;
use App\Item;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addToCart(Request $request)
    {
        $item = explode('_',$request->get('productId'));
        $type = $item[0];
        $pid = (int)$item[1];
        $qty = $request->get('Qty');
        if($type=='item'){
            $product = Item::findorFail($pid);
            $title = $product->name;
        }else{
            $product = Buffet::findorFail($pid);
            $title = $product->title;
        }
        $extraimages = [];
        foreach ($product->getMedia('extraimages') as $extra){
            $extraimages[] = $extra->getUrl();
        }
        \Cart::add(array(
            'id' => $request->get('productId'),
            'name' => $title,
            'price' => $product->price,
            'quantity' => $qty,
            'attributes' => array(
                'img'=>optional($product->getFirstMedia('images'))->getUrl(),
                'category'=>optional($product->category)->name,
                'type'=>$type,
                'item_id'=>$pid,
                'extraimages'=>$extraimages
            )
        ));
        return json_encode([
            'msg'=>trans('tr.Item Added to Shopping Cart'),
            'totalQty'=>\Cart::getTotalQuantity(),
            'total'=>\Cart::getTotal()
        ]);

    }

    public function show()
    {
        return view('cart.show');
    }

    public function remove(Request $request)
    {
        $pid = request('productId')?:$request->get('productId');
        \Cart::remove($pid);
        if($request->isMethod('post')) {
            return json_encode([
                'msg'=>trans('tr.Item Removed From Shopping Cart'),
                'totalQty'=>\Cart::getTotalQuantity(),
                'total'=>\Cart::getTotal()
            ]);
        }else{
            return back()->with('alert-danger','tr.Item Removed From Shopping Cart');
        }
    }

    public function destroy()
    {
        \Cart::clear();
        return redirect()->route('frontend.home')->with('alert-success','Cart was Cleared');
    }

    public function update(Request $request)
    {
        $pid = $request->get('productId');
        $qty = $request->get('Qty');
        \Cart::update($pid, array(
            'quantity' => array(
                'relative' => false,
                'value' => $qty
            ),
        ));
        return json_encode([
            'msg'=>trans('tr.Item Quantity Updated Successfuly'),
            'totalQty'=>\Cart::getTotalQuantity(),
            'total'=>\Cart::getTotal()
            ]);
    }
    public function checkout(Request $request){
        if($request->isMethod('post')){
            try{
                DB::beginTransaction();
                $input = $request->except('_token');
                $input['discount'] = 0;
                $input['client_id'] = auth('web')->user()->id;
                $order = Order::create($input);
                $i = 0;
                foreach(\Cart::getContent() as $item){
                    $details[$i]["price"] = $item->price;
                    $details[$i]["qty"] = $item->quantity;
                    $details[$i]["recived_qty"] = null;
                    if($item->attributes['type']=='buffet'){
                        $details[$i]["buffet_id"] = (int) $item->attributes['item_id'];
                        $details[$i]["item_id"] = null;
                    }else{
                        $details[$i]["item_id"] = (int) $item->attributes['item_id'];
                        $details[$i]["buffet_id"] = null;
                    }
                    $i++;
                }
                if(isset($details)){
                    $order->details()->attach($details);
                }
                $order->setStatus(Status::PENDING, 'Add Order From Website');
                event(new OrderStatusChanged($order));
                DB::commit();
                return redirect()->route('frontend.thanks')->with('alert-success',trans('tr.Your Order has been placed successfuly'));
            }catch (\Exception $e){
                DB::rollBack();
                $error = json_decode($e->getMessage())?:$e->getMessage();
                dd($error);
                return back()->withErrors($error);
            }
        }
        return view('cart.checkout');
    }

    public function thanks(){
        return view('cart.thanks');
    }
}
