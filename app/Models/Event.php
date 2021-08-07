<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'title',
        'content'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
