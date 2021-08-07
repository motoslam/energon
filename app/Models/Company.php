<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'company_type_id',
        'company_status_id',
        'company_purchase_id',
        'potentiality_id',
        'city_id',
        'name',
        'legal',
        'ssn',
        'description',
        'address',
        'contract',
        'specification',
        'manager_bonus',
        'working_hours',
        'equipment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function companyType()
    {
        return $this->belongsTo(CompanyType::class);
    }

    public function companyStatus()
    {
        return $this->belongsTo(CompanyStatus::class);
    }

    public function companyPurchase()
    {
        return $this->belongsTo(CompanyPurchase::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function potentiality()
    {
        return $this->belongsTo(Potentiality::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function awaits()
    {
        return $this->hasMany(CompanyAwait::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class)->orderBy('created_at', 'DESC');
    }

    /** Setters & Getters */
    public function getFullNameAttribute($value)
    {
        return "{$this->legal} {$this->name}";
    }

    protected static function booted()
    {
        static::created(function ($company) {
            $company->events()->create([
                'user_id' => Auth::user()->id,
                'title' => 'Организация добавлена в систему: ' . Auth::user()->name
            ]);
        });
    }

    public function getRouteKeyName()
    {
        return 'ssn';
    }

}
