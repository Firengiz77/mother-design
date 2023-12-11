<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class AttributeProduct extends Model
{
    use HasFactory,HasTranslations;

    protected $table = 'attribute_product';
    public $translatable = ['value'];


    public function getAttribute2()
    {
        return $this->hasOne(Attribute::class,'id','attribute_id');
    }


}
