<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'internal_id',
        'data',
        'total',
        'order_date'
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    protected $appends = ['sum'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getSumAttribute()
    {
        return number_format($this->total, 2, '.', ' ');
    }

}
