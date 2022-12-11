<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Contract extends Model
{
    use HasTranslations;

    public $fillable = ['title','content'];

    public $translatable = ['title','content'];

}
