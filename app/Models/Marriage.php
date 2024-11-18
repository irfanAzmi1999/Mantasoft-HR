<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    public $table = 'marriages';
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'marital_id',
        'marriage_date',
        'spouse_name',
        'spouse_job',
        'spouse_company',
        'delete_marriage',
        'deleted_at'
    ];
    public function getProfiles()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    } 
    public function getMarital()
    {
        return $this->belongsTo(Marital::class, 'marital_id', 'id');
    }
}