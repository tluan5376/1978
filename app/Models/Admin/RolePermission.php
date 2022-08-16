<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;
    protected $table = 'role_permission';
    protected $fillable = ['role_id', 'permission_id', 'status', 'created_at', 'updated_at'];
}
