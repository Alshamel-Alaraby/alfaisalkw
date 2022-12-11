<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class Order extends Model
{
    use HasStatuses;
    protected $fillable = ['client_id','day','start_time','end_time','note',
        'mobile','address','payment_method','total','final_total','discount','paid','due'
        ,'delegator_id','supervisor_id','contract_number',
        'rece_number','rece_date','party_address'];


    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function supervisor(){
        return $this->belongsTo(User::class,'supervisor_id','id');
    }

    public function delegator(){
        return $this->belongsTo(User::class,'delegator_id','id');
    }

    public function details(){
        return $this->belongsToMany(Item::class,'order_detailes','order_id','item_id')
            ->withPivot('price','is_sub','qty','recived_qty','item_id','buffet_id');
    }

    public function tasks(){
        return $this->belongsToMany(Task::class,'order_task','order_id','task_id')
            ->withPivot('status','start','note','user_id');
    }
    public function orderTasks(){
        return $this->hasMany(OrderTask::class,'order_id','id');
    }

    public function orderTask(){
        return $this->hasMany(OrderTask::class);
    }

    public function buffet(){
        return $this->belongsToMany(Buffet::class,'order_detailes','order_id','buffet_id')
            ->withPivot('price','is_sub','qty','recived_qty','item_id','buffet_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class,'order_id','id');
    }

    public function additions(){
        return $this->hasMany (Addition::class,'order_id','id');
    }

    public function discounts(){
        return $this->hasMany (Discount::class,'order_id','id');
    }

    public function getTotalPaidAttribute(){
        return $this->payments()->sum('value') + $this->paid;
    }

    public function getRemainingAttribute(){
        return $this->total + $this->additions()->sum('value') - $this->total_paid - $this->discounts ()->sum ('value');
    }


    public function scopeFilter(Builder $builder)
    {
        $from = request('fromdate');
        $to = request('todate');
        $supervisor_id = request('supervisor_id');
        if(auth()->user()->roles[0]->name!="Admin"){
            if (!auth()->user()->can('List Orders')){
                $builder->whereHas('orderTasks',function($query){
                    $query->where('department_id',auth()->user()->department_id);
                    $query->where(function($q){
                        $q->whereNull('user_id')
                            ->orwhere('user_id',auth()->user()->id);
                    });
                });
            }

        }
        //$builder->where('supervisor_id',auth()->user()->id);

        if(request('status'))
            $builder->currentStatus(request('status'));
        if (!empty($from))
            $builder->whereRaw("DATE(day) >= '{$from}'");
        if (!empty($to))
            $builder->whereRaw("DATE(day) <= '{$to}'");
        return $builder->latest();
    }


    public function decors(){
        return $this->belongsToMany  (Item::class,OrderDetail::class,'order_id','item_id')->where ('type','decor');
    }

    public function decor_title(){
        $title = '';
        foreach ($this->decors as $decor){
            $title .= '&'.$decor->name;
        }
        return trim($title,'&');
    }
}
