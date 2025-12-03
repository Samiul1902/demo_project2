<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Add all seeders here
        $this->call([
            ServiceSeeder::class,
            // Later: BranchSeeder::class, StaffSeeder::class, etc.
        ]);
    }
}
