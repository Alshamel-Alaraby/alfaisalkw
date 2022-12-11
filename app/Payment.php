<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id','value','receipt_number','receipt_date','note'];

    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
