<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * This loads core catalog data (services, staff) so that
     * customers can browse services and book appointments,
     * and admins can manage staff as described in the SRS.[file:1]
     */
    public function run(): void
    {
        $this->call([
            ServiceSeeder::class,
            StaffSeeder::class,
            // Later you can add:
            // BranchSeeder::class,
            // BookingSeeder::class,
            // UserSeeder::class,
        ]);
    }
}
