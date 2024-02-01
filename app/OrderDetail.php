<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;


class OrderDetail extends Model
{
    use LogsActivity;
    use LogsActivity;

    protected $table = 'order_detailes';

    protected $fillable = ['order_id','price','is_sub','qty','recived_qty','item_id','buffet_id'];

    protected static $logAttributes = ['order_id','price','is_sub','qty','recived_qty','item_id','buffet_id'];


    protected static $logName = 'Order details';

    public function getDescriptionForEvent(string $eventName): string
    {
        $user = @auth()->user()->name ?: "system";

        return "This Order details has been {$eventName} by ($user)";
    }

    public function activityLogs()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function buffet(){
        return $this->belongsTo(Buffet::class);
    }


    public function scopeFilter(Builder $builder)
    {
        $builder->with(['item','order']);
        $from = request('fromdate');
        $to = request('todate');
        $status = request('status');
        $builder->whereHas('item',function($query){
            $query->where('type','decor');
        });
        $builder->whereHas('order',function($query)use($from,$to,$status){
            if($status)
                $query->currentStatus($status);
            if (!empty($from))
                $query->whereRaw("DATE(day) >= '{$from}'");
            if (!empty($to))
                $query->whereRaw("DATE(day) <= '{$to}'");
        });
        return $builder->orderBy('order_id','DESC');
    }




}
