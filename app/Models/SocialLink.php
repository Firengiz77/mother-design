<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;


class SocialLink extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;

    public $translatable = ['title'];


}
