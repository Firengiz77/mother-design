<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasFactory,HasTranslations;

    public $translatable = ['name'];

 
    public function attribute_option(){
        return $this->hasMany(Option::class,'attribute_id');
    }


}
