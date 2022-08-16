<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAuth extends Model
{
    use HasFactory;
    protected $table = 'customer_auth';
    protected $fillable = ['secret_key', 'email', 'password', 'verify_code', 'login_type', 'view_type', 'status', 'created_at', 'updated_at'];
}
