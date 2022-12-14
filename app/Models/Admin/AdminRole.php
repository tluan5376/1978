<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;
    protected $table = 'admin_role';
    protected $fillable = ['role_id', 'admin_id', 'status', 'created_at', 'updated_at'];
}
