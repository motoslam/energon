<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'region_id', 'tax_office', 'type', 'name',
        'full_name', 'postal_code', 'fias_id', 'geo_lat',
        'geo_lon', 'federal_district', 'foundation_year',
        'timezone_offset'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

}
