<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        Branch::query()->delete();

        Branch::insert([
            [
                'name'      => 'Banani Branch',
                'code'      => 'BANANI',
                'address'   => 'Banani, Dhaka',
                'phone'     => '01700000001',
                'is_active' => true,
            ],
            [
                'name'      => 'Dhanmondi Branch',
                'code'      => 'DHAN',
                'address'   => 'Dhanmondi, Dhaka',
                'phone'     => '01700000002',
                'is_active' => true,
            ],
            [
                'name'      => 'Gulshan Branch',
                'code'      => 'GUL',
                'address'   => 'Gulshan, Dhaka',
                'phone'     => '01700000003',
                'is_active' => true,
            ],
        ]);
    }
}
