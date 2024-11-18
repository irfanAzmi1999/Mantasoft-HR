<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relations extends Model
{
    public $table = 'relations';
    use HasFactory;

    protected $fillable = [
        'name',
        'delete_relation',
        'deleted_at'
    ];
}