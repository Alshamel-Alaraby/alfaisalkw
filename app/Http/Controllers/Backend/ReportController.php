<?php

namespace App\Http\Controllers\Backend;

use App\Enum\Status;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class ReportController extends BaseController
{

    public function getDaily()
    {
        $list = [];
        return view('backend.reports.daily',compact('list'));
    }

    public function getSales()
    {
        $list = Order::query();
        $list = $list->filter()->get();
        return view('backend.reports.sales',compact('list'));
    }

    public function getMinus()
    {
        $list = OrderDetail::whereHas('item',function($q){
                $q->where('observe_qty',1);
            })->whereHas('order',function($q){
                $q->currentStatus(Status::FINISHED);
            })->where(function($q){
                $q->whereRaw('recived_qty < qty')
                ->orWhereNull('recived_qty');
            })
            ->with('order','item')
            ->get();
        return view('backend.reports.minus',compact('list'));
    }

    public function getDecorsReport()
    {
        $list = OrderDetail::query()->filter();
        $list = $list->get();
        return view('backend.reports.decors',compact('list'));
    }

}
