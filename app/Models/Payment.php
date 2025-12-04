<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'store_id',
        'tran_id',
        'currency',
        'amount',
        'status',
        'gateway_payload',
    ];

    protected $casts = [
        'gateway_payload' => 'array',
        'amount'          => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
