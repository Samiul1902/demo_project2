<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'name',
        'role',
        'branch',
        'status',       // Active / Inactive
        'shift_start',  // FR‑11 schedule fields.[file:1]
        'shift_end',
        'weekly_off',
    ];
}
