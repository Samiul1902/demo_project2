<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'day_of_week',
        'status',
        'start_time',
        'end_time',
        'branch',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
