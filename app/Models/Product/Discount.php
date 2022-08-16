<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discount';
    protected $fillable = ['product_id', 'percent', 'type', 'time_end', 'status', 'created_at', 'updated_at'];
}
