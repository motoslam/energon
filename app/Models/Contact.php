<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'position',
    ];

    protected $appends = ['template'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function phones()
    {
        return $this->hasMany(ContactPhone::class);
    }

    public function emails()
    {
        return $this->hasMany(ContactEmail::class);
    }

    public function event()
    {
        return $this->morphOne(Event::class, 'attachable');
    }

    public function getTemplateAttribute()
    {
        return 'contact';
    }

    protected static function booted()
    {
        static::created(function ($contact) {
            $event = $contact->company->events()->create([
                'user_id' => Auth::user()->id,
                'title' => 'Добавлен контакт',
            ]);
            $event->attachable()->associate($contact);
            $event->save();
        });
    }

}
