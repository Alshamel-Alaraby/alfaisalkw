<?php

namespace App;

use App\Enum\Status;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Translatable\HasTranslations;

class Item extends Model implements HasMedia
{
    use HasTranslations, HasMediaTrait;

    public $fillable = [
        'category_id', 'name', 'description', 'price',
        'qty', 'type', 'has_qty', 'has_price', 'observe_qty', 'is_visible',
    ];

    public $translatable = ['name', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detailes()
    {
        $date = date('Y-m-d', strtotime("-3 Months"));
        return $this->belongsToMany(Order::class, OrderDetail::class, 'item_id', 'order_id')
            ->whereRaw("DATE(day) >= '{$date}'")
            ->currentStatus([Status::PENDING, Status::REVIEWED, Status::INPROGRESS]);
    }

    public function availableQty($date)
    {

        $rQty = OrderDetail::query()->where('item_id', $this->id)->whereHas('order', function ($q) use ($date) {
            $q->whereRaw("DATE(day) = '{$date}'")
                ->currentStatus([Status::PENDING, Status::REVIEWED, Status::INPROGRESS]);
        })->sum('qty');

        $qty = $this->qty - $rQty;

        return $qty;
    }

}
