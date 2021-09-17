<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'title',
    ];

    protected $appends = ['template'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachable()
    {
        return $this->morphTo();
    }

    public function getTemplateAttribute()
    {
        $templates = [
            'App\Models\Order' => 'ss-order',
            'App\Models\Comment' => 'ss-comment',
            'App\Models\Offer' => 'ss-offer',
            'App\Models\Call' => 'ss-call',
        ];
        return $templates[$this->attachable_type] ?? '';
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }

}
