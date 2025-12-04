<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        Staff::query()->delete();

        Staff::insert([
            [
                'name'        => 'Ayesha Rahman',
                'role'        => 'Stylist',
                'branch'      => 'BANANI',
                'status'      => 'Active',
                'shift_start' => '10:00 AM',
                'shift_end'   => '08:00 PM',
                'weekly_off'  => 'Monday',
            ],
            [
                'name'        => 'Karim Hossain',
                'role'        => 'Barber',
                'branch'      => 'DHAN',
                'status'      => 'Active',
                'shift_start' => '10:00 AM',
                'shift_end'   => '08:00 PM',
                'weekly_off'  => 'Tuesday',
            ],
            [
                'name'        => 'Nusrat Jahan',
                'role'        => 'Makeup Artist',
                'branch'      => 'GUL',
                'status'      => 'Active',
                'shift_start' => '11:00 AM',
                'shift_end'   => '09:00 PM',
                'weekly_off'  => 'Wednesday',
            ],
        ]);
    }
}
