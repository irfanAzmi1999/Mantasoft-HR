<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    public $table = 'nationalities';
    use HasFactory;

    protected $fillable = [
        'name',
        'delete_nationality',
        'deleted_at'
    ];
}