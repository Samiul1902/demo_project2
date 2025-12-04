<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'booking_id',
        'customer_name',
        'customer_phone',
        'rating',
        'comments',
        'target_type',
        'target_name',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
