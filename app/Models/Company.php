<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $table = 'companies';
    use HasFactory;

    protected $fillable = [
        'name',
        'delete_company',
        'deleted_at'
    ];
}