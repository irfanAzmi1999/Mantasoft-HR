<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{
    public $table = 'bloods';
    use HasFactory;

    protected $fillable = [
        'name',
        'delete_blood',
        'deleted_at'
    ];
}