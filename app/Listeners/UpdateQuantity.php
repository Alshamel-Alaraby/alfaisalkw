<?php

namespace App\Listeners;

use App\Enum\Status;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try {
            $order = $event->order;
            $today = date('Y-m-d');
            //if(in_array($order->status,[Status::PENDING,Status::FINISHED,Status::CANCELLED])){
                $details = $order->details;
                $buffets = $order->buffet;
                $checkError = false;
                $errors = array();
                foreach ($details as $item){
                    if(!$item->observe_qty) continue;
                    if(
                        in_array($order->status,[Status::PENDING,Status::INPROGRESS,Status::REVIEWED])
                        && $order->day==$today && $item->pivot->is_sub == 0){
                        if($item->qty<$item->pivot->qty){
                            $checkError = true;
                            $errors[] = $item->name . ' خطأ هذه الصنف غير متاح فى هذا اليوم الكمية المتاحة هى  '.$item->qty.' ولكن الكمية المطلوبة هى '.$item->pivot->qty;
                        }
                        $item->qty -= $item->pivot->qty;
                        $item->save();
                        $item->pivot->is_sub = 1;
                        $item->pivot->save();
                    }
                    if($order->status==Status::CANCELLED && $item->pivot->is_sub == 1){
                        $item->qty += $item->pivot->qty;
                        $item->save();
                        $item->pivot->is_sub = 0;
                        $item->pivot->save();
                    }
                    if($order->status==Status::FINISHED && $item->pivot->is_sub == 1){
                        if($item->pivot->recived_qty){
                            $item->qty += $item->pivot->recived_qty;
                            $item->save();
                            $item->pivot->is_sub = 0;
                            $item->pivot->save();
                        }
                    }
                }

                foreach ($buffets as $buffet){
                    foreach ($buffet->details as $item){
                        if(!$item->observe_qty) continue;
                        if($order->status==Status::PENDING){
                            if($item->qty<$item->pivot->qty){
                                $checkError = true;
                                $errors[] = $buffet->title ." ".$item->name . ' required quantity is not available, available is '.$item->qty.' but required is '.$item->pivot->qty;
                            }
                            $item->qty -= $item->pivot->qty;
                            $item->save();
                        }
                        if($order->status==Status::CANCELLED){
                            $item->qty += $item->pivot->qty;
                            $item->save();
                        }
                        if($order->status==Status::FINISHED){
                            if($item->pivot->recived_qty){
                                $item->qty += $item->pivot->recived_qty;
                                $item->save();
                            }
                        }
                    }
                }

                if($checkError){
                    throw new \Exception(json_encode($errors));
                }
            //}
        }catch (\Exception $exception){
            throw $exception;
        }
    }
}
