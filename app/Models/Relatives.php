<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatives extends Model
{
    public $table = 'relatives';
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'relation_id',
        'name',
        'email', 
        'phone',
        'job',
        'is_emergency',
        'delete_relative',
        'deleted_at'
    ];

    public function getProfiles()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }
     
    public function changeIdRelatives()
    {
        return $this->belongsTo(Relations::class, 'relation_id', 'id');
    }
}