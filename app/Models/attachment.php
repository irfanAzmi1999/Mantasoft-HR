<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public $table = 'attachments';
    use HasFactory;

    protected $fillable = [
        'leave_id',
        'name',
        'type',
        'size',
        'delete_attachment',
        'deleted_at'
    ];

    public function getLeaveDetail()
    {
        return $this->belongsTo(User::class, 'leave_id', 'id');
    }
}