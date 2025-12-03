<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * Mass-assignable attributes for services.
     * Covers name, category, duration, price, branch, status, and description
     * which are needed for browsing services (FR‑2) and admin management (FR‑10).[file:1]
     */
    protected $fillable = [
        'name',
        'category',
        'duration',
        'price',
        'branch',
        'status',
        'description',
    ];
}
