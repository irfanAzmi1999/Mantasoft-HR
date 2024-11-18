<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeApplication extends Model
{
    public $table = 'overtime_applications';
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'date',
        'time_in',
        'time_out',
        'latitude',
        'longitude',
        'location',
    ];
    
    public function getUser()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function getOvertime()
    {
        return $this->hasOne(Overtime::class, 'id');
    }
}
