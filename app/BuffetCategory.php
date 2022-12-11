<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Translatable\HasTranslations;

class BuffetCategory extends Model implements HasMedia
{
    use HasTranslations, HasMediaTrait;

    public $fillable = ['name', 'show_in_home', 'description'];

    public $translatable = ['name', 'description'];

    public function cover()
    {
        return $this->morphOne(config('medialibrary.media_model'), 'model');
    }

    public function scopeParent(Builder $builder)
    {
        return $builder->whereNull('parent_id');
    }
}
