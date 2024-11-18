<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $table = 'attendances';
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'Y-m-d',
        'emergencytype_id',
        'latitude_in',
        'longitude_in',
        'location_in',
        'time_in',
        'photo_in',
        'reasonLate_in',
        'latitude_out',
        'longitude_out',
        'location_out',
        'time_out',
        'photo_out',
        'reason_out'
    ];

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
