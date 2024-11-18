<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $table = 'profiles';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nationality_id',
        'blood_id',
        'phone',
        'address',
        'dob',
        'pob',
        'gender',
        'height',
        'weight',
        'nokp_new',
        'nokp_old',
        'epf',
        'tax',
        'image',
        'delete_profile',
        'deleted_at'
    ];

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getNationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id', 'id');
    }

    public function getBlood()
    {
        return $this->belongsTo(Blood::class, 'blood_id', 'id');
    }
}