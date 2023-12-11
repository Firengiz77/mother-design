<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionProduct extends Model
{
    use HasFactory;

    protected $table = 'option_product';

    public function getOption(){
        return $this->hasMany(Option::class,'id','option_id');
    }
    public function getOptionAttribute(){
        return $this->hasOne(Option::class,'id','option_id');
    }
}
