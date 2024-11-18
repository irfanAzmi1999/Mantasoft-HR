<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    public $table = 'publicholidays';
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'order_in_year',
        'delete_holiday',
        'deleted_at'
    ];
}