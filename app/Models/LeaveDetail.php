<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveDetail extends Model
{
    public $table = 'leavedetails';
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'leavetype_id',
        'emergencytype_id',
        'status_id',
        'approver_id',
        'apply_date',
        'half_day',
        'start_date',
        'end_date',
        'date_leave',
        'staff_remarks',
        'approver_remarks',
        'delete_leavedetail',
        'deleted_at'
    ];
    
    public function getStaff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function getLeaveType()
    {
        return $this->hasOne(LeaveType::class, 'id','leavetype_id');
    }

    public function getEmergencyType()
    {
        return $this->belongsTo(EmergencyType::class, 'emergencytype_id', 'id');
    }
    
    public function getStatus()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
    
    public function getApprover()
    {
        return $this->belongsTo(Staff::class, 'superior_id', 'id');
    }
}