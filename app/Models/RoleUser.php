<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    public $table = 'role_user';
    use HasFactory;

    protected $fillable = [
        'role_id',
        'user_id',
        'user_type',
        'delete_roleuser',
        'deleted_at'
    ];

    public function getRole()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}