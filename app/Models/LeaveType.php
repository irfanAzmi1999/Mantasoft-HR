<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    public $table = 'leavetypes';
    use HasFactory;

    protected $fillable = [
        'name',
        'limit',
        'delete_leavetype',
        'deleted_at'
    ];
}