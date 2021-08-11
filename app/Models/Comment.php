<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'contact_id',
        'data'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function event()
    {
        return $this->morphOne(Event::class, 'attachable');
    }

    public function getTemplateAttribute()
    {
        return 'comment';
    }

}
