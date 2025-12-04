<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'service_id',
        'branch',
        'stylist_preference',
        'date',
        'time',
        'notes',
        'status',
        'total_price',
        'loyalty_points', // new field for FR‑15/FR‑20.[file:1]
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
}
