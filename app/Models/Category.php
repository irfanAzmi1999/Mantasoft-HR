<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';
    use HasFactory;

    protected $fillable = [
        'name',
        'delete_category',
        'deleted_at'
    ];
}