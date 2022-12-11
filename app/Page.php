<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Translatable\HasTranslations;

class Page extends Model implements HasMedia
{
    use HasTranslations, HasMediaTrait;

    public $fillable = ['title','content','slug'];

    public $translatable = ['title','content'];

    public function setSlugAttribute()
    {
        $this->attributes['slug'] = Str::slug($this->title);
    }

}
