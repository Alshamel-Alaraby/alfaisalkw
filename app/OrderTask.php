<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTask extends Model
{
    protected $table = 'order_task';
    public $fillable = ['order_id','department_id','task_id','user_id','start','status','note'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function task(){
        return $this->belongsTo(Task::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
