<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public $table = 'positions';
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'delete_position',
        'deleted_at'
    ];

    public function getDepartment()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}