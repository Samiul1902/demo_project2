<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'customer_name',
        'customer_phone',
        'branch',
        'date',
        'time',
        'stylist_preference',
        'notes',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(\App\Models\Service::class);
    }
}
