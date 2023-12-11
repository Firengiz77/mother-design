<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Option extends Model
{
    use HasFactory,HasTranslations;


    public $translatable = ['value'];


    public function getAttributeOption(){
     return $this->hasOne(Attribute::class,'id','attribute_id');
    }

}
