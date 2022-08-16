<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDetail extends Model
{
    use HasFactory;
    protected $table = 'admin_detail';
    protected $fillable = ['admin_auth_id', 'username', 'avatar', 'telephone', 'identity', 'address', 'status', 'created_at', 'updated_at'];
}
