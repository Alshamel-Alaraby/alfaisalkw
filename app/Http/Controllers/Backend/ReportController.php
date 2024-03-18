<?php

namespace App\Http\Controllers\Backend;

use App\Enum\Status;
use App\Item;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class ReportController extends BaseController
{

    public function getDaily()
    {
        $list = [];
        return view('backend.reports.daily', compact('list'));
    }

    public function getSales()
    {
        $list = Order::query();
        $list = $list->filter()->get();
        return view('backend.reports.sales', compact('list'));
    }

    public function getMinus()
    {
        $list = OrderDetail::whereHas('item', function ($q) {
            $q->where('observe_qty', 1);
        })->whereHas('order', function ($q) {
            $q->currentStatus(Status::FINISHED);
        })->where(function ($q) {
            $q->whereRaw('recived_qty < qty')
                ->orWhereNull('recived_qty');
        })
            ->with('order', 'item')
            ->get();
        return view('backend.reports.minus', compact('list'));
    }

    // public function getDecorsReport()
    // {
    //     $list = OrderDetail::query()->filter();
    //     $list = $list->get();
    //     return view('backend.reports.decors',compact('list'));
    // }

    public function getDecorsReport(Request $request)
    {

        $fromDate = $request->input('fromdate');

        $items = Item::with(['detailes' => function ($query) use ($fromDate) {
            $query->whereHas('orderDetails', function ($subquery) use ($fromDate) {
                $subquery->whereDate('day', $fromDate);
            });
        }])->get();


        $items->each(function ($item) use ($fromDate) {
            $item->balance = $item->qty;
            if ($fromDate) {

                $item->reserved = OrderDetail::where('item_id', $item->id)
                    ->whereHas('order', function ($subQuery) use ($fromDate) {
                        $subQuery->whereDate('day', $fromDate);
                    })
                    ->sum('qty');
            } else {

                $item->reserved = 0;
            }
            $item->remaining = $item->qty - $item->reserved;
        });
        ///////////////////////////////////////////////////////////////////////

        return view('backend.reports.decors_new', compact('items'));

    }

}
