<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $fillable = ['title','description','department_id'];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
