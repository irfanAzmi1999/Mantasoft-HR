<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveQuota extends Model
{
    public $table = 'leavequotas';
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'year',
        'default',
        'taken',
        'balance',
        'mc_default',
        'mc_taken',
        'mc_balance',
        'maternity',
        'paternity',
        'delete_quota',
        'deleted_at'
    ];

    public function getStaff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }
}
