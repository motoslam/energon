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
        'senior_id',
        'company_id',
        'content',
        'task_status_id',
        'priority_id',
        'need_confirm',
        'deadline_at',
        'started_at',
        'closed_at'
    ];

    protected $casts = [
        'deadline_at' => 'datetime',
        'started_at' => 'datetime',
        'closed_at' => 'datetime'
    ];

    protected $appends = [
        'priority',
        'expired'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function senior()
    {
        return $this->belongsTo(User::class, 'senior_id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'task_status_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getPriorityAttribute()
    {
        return [
            'regular' => 'Нормальный',
            'average' => 'Высокий',
            'critical' => 'Критичный',
        ][$this->attributes['priority_id']];
    }

    public function getExpiredAttribute()
    {
        return $this->attributes['deadline_at'] < now();
    }
}
