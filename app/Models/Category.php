<?php

namespace App\Models;

use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, HasSlug,HasTranslations,SoftDeletes;


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public $translatable = ['name','slug'];

    public function scopeIsSlug($query,$slug)
    {
        return $query->where('slug', 'like','%'.$slug.'%');
    }

    public function scopeIsActive($query)
    {
        return $query->where('status',1);
    }

    public function scopeIsFavorite($query)
    {
        return $query->where('favorite',1);
    }


    public function getCategory(){
        return $this->hasOne(Category::class,'id','parent_id');
    }

    public function getInnovation(){
        return $this->hasOne(Innovation::class,'id','innovation_id');
    }

    public function getProducts(){
        return $this->hasMany(Product::class,'id','product_id');
    }

    
}
