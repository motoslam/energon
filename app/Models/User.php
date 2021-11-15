<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo',
        'show_detail_company'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => 'array'
    ];

    protected $attributes = array(
        'settings' => ''
    );

    public function companies()
    {
        return $this->hasMany(Company::class)->orderBy('name');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)
            ->orderBy('deadline_at', 'ASC');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function awaits()
    {
        return $this->hasMany(CompanyAwait::class);
    }

    public function calls()
    {
        return $this->hasMany(Call::class);
    }

    public function setting(string $name, $default = null)
    {
        if(!$this->settings) $this->settings = [];
        if (array_key_exists($name, $this->settings)) {
            return $this->settings[$name];
        }
        return $default;
    }

    public function settings(array $revisions, bool $save = true): self
    {
        if(!$this->settings) $this->settings = [];
        $this->settings = array_merge($this->settings, $revisions);
        if ($save) {
            $this->save();
        }
        return $this;
    }

    /** closed methods */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
