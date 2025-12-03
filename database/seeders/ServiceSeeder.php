<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data in dev
        Service::truncate();

        Service::insert([
            // Hair services
            [
                'name'        => 'Premium Haircut',
                'category'    => 'Hair',
                'duration'    => 45,
                'price'       => 800,
                'branch'      => 'Banani',
                'status'      => 'Active',
                'description' => 'Personalized haircut with style consultation.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Basic Haircut',
                'category'    => 'Hair',
                'duration'    => 30,
                'price'       => 500,
                'branch'      => 'Dhanmondi',
                'status'      => 'Active',
                'description' => 'Quick trim and simple styling for regular maintenance.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Hair Color (Full)',
                'category'    => 'Hair',
                'duration'    => 120,
                'price'       => 3500,
                'branch'      => 'Gulshan',
                'status'      => 'Active',
                'description' => 'Full-head hair coloring with premium products.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Hair Spa',
                'category'    => 'Spa',
                'duration'    => 90,
                'price'       => 1500,
                'branch'      => 'Banani',
                'status'      => 'Active',
                'description' => 'Deep conditioning hair spa with relaxing head massage.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // Skin / facial
            [
                'name'        => 'Facial Treatment',
                'category'    => 'Skin',
                'duration'    => 60,
                'price'       => 1200,
                'branch'      => 'Dhanmondi',
                'status'      => 'Active',
                'description' => 'Deep cleansing facial with steam and mask.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Detox Facial',
                'category'    => 'Skin',
                'duration'    => 75,
                'price'       => 1800,
                'branch'      => 'Gulshan',
                'status'      => 'Active',
                'description' => 'Detoxifying facial for dull and tired skin.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // Makeup & bridal
            [
                'name'        => 'Bridal Makeup',
                'category'    => 'Makeup',
                'duration'    => 120,
                'price'       => 5000,
                'branch'      => 'Gulshan',
                'status'      => 'Active',
                'description' => 'Full bridal makeup with trial session and hair styling.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Party Makeup',
                'category'    => 'Makeup',
                'duration'    => 60,
                'price'       => 2200,
                'branch'      => 'Banani',
                'status'      => 'Active',
                'description' => 'Glam party look including basic hair styling.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // Spa & packages
            [
                'name'        => 'Body Spa & Massage',
                'category'    => 'Spa',
                'duration'    => 90,
                'price'       => 2800,
                'branch'      => 'Dhanmondi',
                'status'      => 'Active',
                'description' => 'Full body spa and aroma oil massage.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Bridal Package (Day)',
                'category'    => 'Package',
                'duration'    => 240,
                'price'       => 8500,
                'branch'      => 'Gulshan',
                'status'      => 'Active',
                'description' => 'Includes facial, hair spa, bridal makeup and basic manicure.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
