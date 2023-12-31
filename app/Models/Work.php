<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
class Work extends Model
{
    use HasFactory,SoftDeletes,HasTranslations;

    public $translatable = ['name','title','desc'];

    public function getWorkAttributes(){
        return $this->hasMany(WorkAttribute::class,'work_id','id');
    }


}
