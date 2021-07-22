<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tax_office', 'name', 'full_name', 'type', 'federal_district',
        'short_fd', 'fias_id'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function companies()
    {
        return $this->hasManyThrough(Company::class, City::class);
    }

    public function scopeTaxOffice($query, $taxOffice)
    {
        return $query->where('tax_office', $taxOffice);
    }

}
