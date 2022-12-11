<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Translatable\HasTranslations;

class Slider extends Model implements HasMedia
{
    use HasTranslations, HasMediaTrait;

    public $fillable = ['name','link'];

    public $translatable = ['name','link'];

    public function cover()
    {
        return $this->morphOne(config('medialibrary.media_model'), 'model');
    }
}
