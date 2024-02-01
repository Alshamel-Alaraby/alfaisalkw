<?php

namespace App\Http\Controllers\Backend;

use App\Enum\Status;
use App\Events\OrderStatusChanged;
use App\Item;
use App\Order;
use App\OrderTask;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{

    public function closeOrders(){
        $today = date('Y-m-d');
        $orders = Order::currentStatus([Status::PENDING,Status::REVIEWED,Status::INPROGRESS])
            ->where('day','<',$today)
            ->get();
        foreach ($orders as $order){
            if($order->status==Status::PENDING){
                $order->setStatus(Status::CANCELLED, 'الوصول الى يوم الطلب بدون تغيير الحالة');
            }else{
                $order->setStatus(Status::FINISHED, 'تم تغيير الحالة اتوماتيك الى مكتملة');
            }
            event(new OrderStatusChanged($order));
        }
    }

    public function index(){
        $this->closeOrders();
        //$list = $this->getOrder();
        $userCalander = auth()->user()->calendar;
        $status[Status::PENDING] = 0;
        $status[Status::INPROGRESS] = 0;
        $status[Status::FINISHED] = 0;
        $status['all'] = 0;
        if(!empty($userCalander) && in_array('الطلبات',$userCalander)) {
            $list = Order::get();
            $status['all'] = count($list);
            foreach ($list as $order) {
                if ($order->status == Status::PENDING)
                    $status[Status::PENDING]++;
                elseif ($order->status == Status::INPROGRESS)
                    $status[Status::INPROGRESS]++;
                elseif ($order->status == Status::FINISHED)
                    $status[Status::FINISHED]++;
            }
        }
//        $list = $this->getDecorList();
        $list = $this->ords();
        $calander = $list['calander'];


        $calander = json_encode($calander);
//        dd ($calander);
        \JavaScript::put([
            'calander' => $calander,
        ]);
        return view('backend.home',compact('status'));
    }


    public function ords(){
        $date = date('Y-m-d',strtotime("-3 Months"));
        $orders = Order::query ()->whereRaw("DATE(day) >= '{$date}'")
            ->currentStatus([Status::PENDING,Status::REVIEWED,Status::INPROGRESS])
            ->get();
        $calander = [];
        foreach ($orders as $order){
            $date = $order->day;
            $start_time = $order->start_time;
            $end_time = $order->end_time;
            $start = date('Y-m-d H:i:s', strtotime("$date $start_time"));
            $end = date('Y-m-d H:i:s', strtotime("$date $end_time"));
            $calander[]=
                [
                    'title' => $order->decor_title() .' -- '. " رقم العقد # ".$order->contract_number,
                    'start'=> $start,
                    'end'=> $end,
                    'url'=>route('backend.orders.show',$order->id),
                    'backgroundColor'=> $this->getColor($order->status),
                    'borderColor'=> $this->getColor($order->status),
                ];
        }
        return ['calander'=>$calander];
    }




    public function getDecorList(){
        $decors = Item::where('type','decor')->with('detailes')->get();
        $calander = [];
        foreach ($decors as $decor){
            //dd($decor);
            foreach ($decor->detailes as $order){
                $date = $order->day;
                $start_time = $order->start_time;
                $end_time = $order->end_time;
                $start = date('Y-m-d H:i:s', strtotime("$date $start_time"));
                $end = date('Y-m-d H:i:s', strtotime("$date $end_time"));
                $calander[]=
                    [
                        'title' => $decor->name . " طلب # ".$order->id,
                        'start'=> $start,
                        'end'=> $end,
                        'url'=>route('backend.orders.show',$order->id),
                        'backgroundColor'=> $this->getColor($order->status),
                        'borderColor'=> $this->getColor($order->status),
                    ];
            }
        }
        return ['calander'=>$calander];
    }

    public function getOrder(){
        $userCalander = auth()->user()->calendar;
        $status[Status::PENDING] = 0;
        $status[Status::INPROGRESS] = 0;
        $status[Status::FINISHED] = 0;
        $status['all'] = 0;
        $calander = [];
        if(!empty($userCalander) && in_array('الطلبات',$userCalander)){
            $list = Order::get();
            $status['all'] = count($list);
            foreach ($list as $order){
                if($order->status==Status::PENDING)
                    $status[Status::PENDING]++;
                elseif($order->status==Status::INPROGRESS)
                    $status[Status::INPROGRESS]++;
                elseif($order->status==Status::FINISHED)
                    $status[Status::FINISHED]++;
                $date = $order->day;
                $start_time = $order->start_time;
                $end_time = $order->end_time;
                $start = date('Y-m-d H:i:s', strtotime("$date $start_time"));
                $end = date('Y-m-d H:i:s', strtotime("$date $end_time"));
                $calander[]=
                    [
                        'title' => " طلب # ".$order->id,
                        'start'=> $start,
                        'end'=> $end,
                        'url'=>route('backend.orders.show',$order->id),
                        'backgroundColor'=> "#fd397a",
                        'borderColor'=> "#fd397a",
                    ];
            }
        }
        if(!empty($userCalander) && in_array('المهمات',$userCalander)) {
            $list = OrderTask::query();
            if (auth()->user()->roles[0]->name != "Admin") {
                $list->where(function ($query) {
                    $query->whereNull('user_id');
                    $query->where('department_id', auth()->user()->department_id);
                })->orwhere(function ($query) {
                    $query->where('user_id', auth()->user()->id);
                    $query->where('department_id', auth()->user()->department_id);
                });
            }
            $tasks = $list->latest()->get();
            foreach ($tasks as $t) {
                if ($t->status == "بدأ") {
                    $bgColor = $this->getColor($order->status);
                } elseif ($t->status == "قيد الانتظار") {
                    $bgColor = "#FF9800";
                } else {
                    $bgColor = "#0000ff";
                }
                $calander[] =
                    [
                        'title' => optional($t->task)->title . "  # " . $t->order_id,
                        'start' => $t->start,
                        'url' => route('backend.ordertasks.edit', $t->id),
                        'backgroundColor' => $bgColor,
                        'borderColor' => $bgColor,
                    ];
            }
        }
        return ['calander'=>$calander,'status'=>$status];
    }


    protected function getColor($status)
    {
        switch ($status) {
            case Status::PENDING:
                return '#f39c12';
            case Status::INPROGRESS:
                return '#00c0ef';
            case Status::FINISHED:
                return '#00a65a';
            case Status::CANCELLED:
                return '#dd4b39';
            default:
                return '#00a65a';
        }
    }

}
