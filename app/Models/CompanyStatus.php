<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'short_name'
    ];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function scopeAllowed($query)
    {
        return $query->where('id', '<>', 5)->get();
    }

}
