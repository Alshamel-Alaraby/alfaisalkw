<?php

namespace App;
use Spatie\Activitylog\Traits\LogsActivity;


use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use LogsActivity;


    public $fillable = ['name'];

    protected static $logAttributes = ['name',];


    protected static $logName = 'Department';


    public function getDescriptionForEvent(string $eventName): string
    {
        $user = @auth()->user()->name ?: "system";

        return "This Department has been {$eventName} by ($user)";
    }
}
