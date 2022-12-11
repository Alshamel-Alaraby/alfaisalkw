<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use HasTranslations,NodeTrait, HasMediaTrait;

    public $fillable = ['name','parent_id','show_in_home'];

    public $translatable = ['name'];

    protected $appends = ['text','nodes'];

    public function getTextAttribute()
    {
        $text = $this->name;

        $text .= '<p style="margin-left: 100px;display: inline-block;">
                    <img width="100px" src="'.optional($this->getFirstMedia('images'))->getUrl().'"/></p>';

        if(auth()->user()->can('Edit Category')){
            $text .= '<a href="'.route('backend.category.edit',$this->id).'" class="bluebutton catEdit editRecord" >تعديل</a>&nbsp';
        }
        if(auth()->user()->can('Delete Category')){
            $text .= '<a title="Delete" href="#" data-action="'.route('backend.category.destroy',$this->id).'" class="redbutton catDel deleteRecord">حذف</a>';
        }

        return $text;
    }

    public function getNodesAttribute()
    {
        $childrens =  $this->children;

        if(count($childrens) > 0){
            return $this->children;
        }else{
            return null;
        }
    }

    public function cover()
    {
        return $this->morphOne(config('medialibrary.media_model'), 'model');
    }

    public function scopeParent(Builder $builder)
    {
        return $builder->whereNull('parent_id');
    }
}
