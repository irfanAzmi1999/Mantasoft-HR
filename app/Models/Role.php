<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $table = 'roles';
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'delete_role',
        'deleted_at'
    ];
}