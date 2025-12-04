<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::query()->delete();

        Service::insert([
            [
                'name'        => 'Classic Haircut',
                'description' => 'Standard men’s haircut and styling.',
                'price'       => 500,
                'duration'    => 30,
                'status'      => 'Active',
            ],
            [
                'name'        => 'Bridal Makeup',
                'description' => 'Full bridal makeup package.',
                'price'       => 4000,
                'duration'    => 120,
                'status'      => 'Active',
            ],
            [
                'name'        => 'Facial & Skin Care',
                'description' => 'Deep cleansing facial with mask.',
                'price'       => 1500,
                'duration'    => 60,
                'status'      => 'Active',
            ],
        ]);
    }
}
