<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'branch',
        'rating',
        'status',
    ];

    /**
     * Weekly schedules for this staff member (FR‑11: manage staff availability).[file:1]
     */
    public function schedules()
    {
        return $this->hasMany(\App\Models\StaffSchedule::class);
    }
}
