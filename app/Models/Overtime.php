<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    public $table = 'overtimes';
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'overtimeApplication_id',
        'curentDate',
        'clockedTime_in',
        'clockedTime_out',
        'location_in',
        'location_out',
        'provePhoto',
    ];
    
    public function getUser()
    {
        return $this->belongsTo(User::class,'id');
    }

    public function getOvertimeApplication()
    {
        return $this->belongsTo(OvertimeApplication::class,'id');
    }

}
