<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

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
        'offer_number',
        'order_number',
        'order_date',
        'order_total',
        'manager_bonus',
        'working_hours',
        'equipment',
    ];

    protected $appends = ['url'];

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
        return $this->hasMany(Contact::class)->latest();
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

    public function awaits()
    {
        return $this->hasMany(CompanyAwait::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class)->orderBy('created_at', 'DESC');
    }

    /** Setters & Getters */
    public function getFullNameAttribute()
    {
        return "{$this->legal} {$this->name}";
    }

    public function getUrlAttribute()
    {
        return route('companies.show', ['company' => $this]);
    }

    public function setOrderTotalAttribute($value)
    {
        $this->attributes['order_total'] = $value ? preg_replace('/[^0-9]/', '', $value) : null;
    }

    public function setManagerBonusAttribute($value)
    {
        $this->attributes['manager_bonus'] = $value ? preg_replace('/[^0-9]/', '', $value) : null;
    }


    protected static function booted()
    {
        static::created(function ($company) {
            $company->events()->create([
                'user_id' => Auth::user()->id,
                'title' => 'Организация добавлена в систему: ' . Auth::user()->name
            ]);
        });
        //static::updated(function($company){});
    }

    public function getRouteKeyName()
    {
        return 'ssn';
    }

}
