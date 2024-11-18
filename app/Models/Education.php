<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public $table = 'educations';
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'school_name',
        'year_from',
        'year_to',
        'achievement',
        'result',
        'delete_education',
        'deleted_at'
    ];

    public function getProfile()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }
}