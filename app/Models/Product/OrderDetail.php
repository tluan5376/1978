<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $fillable = ['order_id', 'product_id', 'quantity',
                    'prices', 'discount', 'total_price', 
                    'shipping_quantity', 'shipping_status', 
                    'status', 'created_at', 'updated_at'];
}
