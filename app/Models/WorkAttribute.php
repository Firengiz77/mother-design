<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkAttribute extends Model
{
    use HasFactory;

    public function getWork(){
        return $this->hasOne(Work::class,'id','work_id');
    }
}
