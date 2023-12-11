<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\SoftDeletes;


class Blog extends Model
{
    use HasFactory, HasSlug,HasTranslations,SoftDeletes;


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


    public $translatable = ['title','slug', 'desc','meta_title','meta_desc','meta_keyword'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tags', 'blog_id', 'tag_id');
    }

    public function scopeIsSlug($query,$slug)
    {
        return $query->where('slug', 'like','%'.$slug.'%');
    }


    public function scopeIsActive($query)
    {
        return $query->where('status',1);
    }





}
