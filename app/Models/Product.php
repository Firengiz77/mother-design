<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, HasSlug,HasTranslations,SoftDeletes;


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    protected $fillable =['images'];

    public $translatable = ['name','slug','desc','meta_title','meta_desc','meta_keywords'];
    protected $casts = ['images'=>'array','thumb' => 'array'];

    public function scopeIsSlug($query,$slug)
    {
        return $query->where('slug', 'like','%'.$slug.'%');
    }

    public function scopeIsActive($query)
    {
        return $query->where('status',1);
    }

    public function getCategory(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    
    public function getInnovation(){
        return $this->hasOne(Innovation::class,'id','innovation_id');
    }

    public function getAttributeProduct(){
        return $this->hasMany(OptionProduct::class,'product_id');
    }

    public function getOption(){
        return $this->belongsToMany(Option::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

}
