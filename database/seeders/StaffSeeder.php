<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\StaffSchedule;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Seeds core staff so admins can manage schedules and availability (FR‑11).[file:1]
     */
    public function run(): void
    {
        // Clear schedules first because they depend on staff_id.
        StaffSchedule::query()->delete();

        // Use delete() instead of truncate() due to FK from staff_schedules to staff.
        Staff::query()->delete();

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
