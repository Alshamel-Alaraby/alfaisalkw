<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Translatable\HasTranslations;

class Gallery extends Model implements HasMedia
{
    use HasTranslations, HasMediaTrait;

    protected $table = 'gallery';

    public $fillable = ['title','show_in_home'];

    public $translatable = ['title'];

}
