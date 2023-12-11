<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaymentMethod;
use App\Models\Product;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    use HasFactory;
    
    
    public function getProduct(){
        return $this->hasOne(Product::class,'id','product_id');
    }
    


}
