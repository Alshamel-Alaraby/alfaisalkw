<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['item_id', 'photo', 'created_at', 'updated_at'];

}
