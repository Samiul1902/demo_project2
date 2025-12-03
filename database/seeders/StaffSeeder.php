<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        Staff::truncate();

        Staff::insert([
            [
                'name'       => 'Ayesha',
                'role'       => 'Senior Stylist',
                'branch'     => 'Banani',
                'rating'     => 4.8,
                'status'     => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Fahim',
                'role'       => 'Stylist',
                'branch'     => 'Dhanmondi',
                'rating'     => 4.6,
                'status'     => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Nadia',
                'role'       => 'Makeup Artist',
                'branch'     => 'Gulshan',
                'rating'     => 4.9,
                'status'     => 'On leave',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

