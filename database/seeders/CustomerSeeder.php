<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::query()->delete();

        Customer::create([
            'name'             => 'Demo Customer',
            'phone'            => '01711111111',
            'email'            => 'demo@example.com',
            'preferred_branch' => 'BANANI',
        ]);
    }
}
