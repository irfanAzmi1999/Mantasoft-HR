<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marital extends Model
{
    public $table = 'maritals';
    use HasFactory;

    protected $fillable = [
        'name',
        'delete_marital',
        'deleted_at'
    ];
}