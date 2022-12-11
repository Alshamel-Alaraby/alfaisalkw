<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Translatable\HasTranslations;

class Buffet extends Model implements HasMedia
{
    use HasMediaTrait,HasTranslations;
    public $fillable = ['category_id','title','description',
        'number_attendence','price'];
    public $translatable = ['title','description'];
    public function category(){
        return $this->belongsTo(BuffetCategory::class);
    }

    public function details(){
        return $this->belongsToMany(Item::class,'buffet_items','buffet_id','item_id')
            ->withPivot('qty');
    }
    public function visibledetails(){
        return $this->belongsToMany(Item::class,'buffet_items','buffet_id','item_id')
            ->where('is_visible',1)
            ->withPivot('qty');
    }



}
