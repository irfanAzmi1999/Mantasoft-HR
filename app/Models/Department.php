<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $table = 'departments';
    use HasFactory;

    protected $fillable = [
        'name',
        'fullname',
        'order_number',
        'delete_department',
        'deleted_at'
    ];

    public function getPosition()
    {
        return $this->hasMany(Position::class, 'department_id', 'id');
    }
}