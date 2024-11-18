<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyType extends Model
{
    public $table = 'emergencytypes';
    use HasFactory;

    protected $fillable = [
        'name',
        'delete_emergencytype',
        'deleted_at'
    ];
}