<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $table = 'statuses';
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'delete_status',
        'deleted_at'
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}