<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    public $table = 'staffs';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'company_id',
        'employ_date',
        'superior_id',
        'delete_staff',
        'deleted_at'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function getCompany()
    {
        return $this->hasOne(Company::class, 'company_id', 'id');
    }

    public function getStatus()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function getSuperior()
    {
        return $this->hasOne(User::class, 'id', 'superior_id');
    }

    public function getLeaveType()
    {
        return $this->hasOne(LeaveType::class, 'leavetype_id','id');
    }

    public function getLeaveDetail()
    {
        return $this->hasMany(LeaveDetail::class, 'staff_id', 'id');
    }

    public function getLeaveQuota()
    {
        return $this->hasMany(LeaveQuota::class, 'staff_id', 'id');
    }
}