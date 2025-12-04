<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'branch',
        'customer_name',
        'customer_phone',
        'date',
        'time',
        'status',        // Pending, Approved, Rejected, Completed, Cancelled
        'total_price',   // FR‑4, FR‑13.[file:1]
        'loyalty_points',
    ];

    protected $casts = [
        'date'         => 'date',
        'total_price'  => 'decimal:2',
        'loyalty_points' => 'integer',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
