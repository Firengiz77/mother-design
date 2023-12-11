<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
  
    public function getOrderInvoice(){
        return $this->hasOne(OrderInvoice::class,'order_id','id');
    }

    public function getOrderDetail(){
        return $this->hasMany(OrderDetail::class);
    }
}
