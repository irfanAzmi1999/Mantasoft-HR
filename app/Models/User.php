<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'delete_user',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getProfile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function getRoleUser()
    {
        return $this->hasOne(RoleUser::class, 'user_id');
    }

    public function getRoleUserWithRole()
    {
        return $this->hasOne(RoleUser::class, 'user_id')->with('getRole');
    }

    public function getStaff()
    {
        return $this->hasOne(Staff::class, 'user_id', 'id')->with('getDepartment');
    }

    public function getAttendance()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id');
    }

    public function getOvertime()
    {
        return $this->hasMany(Overtime::class, 'user_id', 'id');
    }

    public function getOvertimeApplication()
    {
        return $this->hasMany(OvertimeApplication::class, 'user_id', 'id');
    }
}
