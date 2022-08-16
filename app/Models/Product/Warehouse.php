<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table = 'warehouse';
    protected $fillable = ['product_id', 'quantity', 'reserve', 'status', 'created_at', 'updated_at'];
}
