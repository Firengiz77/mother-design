<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Blog;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;



class Tag extends Model
{
    use HasFactory, HasTranslations,  SoftDeletes;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title') 
            ->saveSlugsTo('slug'); 
    }

    public $translatable = ['title', 'slug'];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_tags', 'tag_id', 'blog_id');
    }
}
