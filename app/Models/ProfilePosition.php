<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePosition extends Model
{
    public $table = 'profilepositions';
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'position_id',
        'department_id',
        'delete_profileposition',
        'deleted_at'
    ];
    
    public function getPosition()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function getDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    
    public function getProfiles()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    } 
}