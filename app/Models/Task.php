<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
        'company_id',
        'content',
        'task_status_id',
        'from_admin',
        'need_confirm',
        'deadline_at',
        'timer',
        'priority',
        'closed_at'
    ];

    protected $casts = [
        'deadline_at' => 'datetime',
        'closed_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
