<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = ['category_id', 'images', 'name', 'slug',
                    'metadata', 'search_name', 'description', 
                    'detail', 'prices', 'defaul_prices', 'trending', 'view', 
                    'status', 'created_at', 'updated_at'];
}
