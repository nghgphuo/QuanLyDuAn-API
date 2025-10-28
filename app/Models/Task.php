<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'priority',
        'created_by',
        'assigned_to',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    // Quan hệ: Task thuộc về user tạo (Admin)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Quan hệ: Task được giao cho user
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
