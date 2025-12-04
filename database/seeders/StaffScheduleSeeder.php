<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\StaffSchedule;

class StaffScheduleSeeder extends Seeder
{
    public function run(): void
    {
        StaffSchedule::query()->delete();

        $days = [1,2,3,4,5]; // Monday–Friday

        foreach (Staff::all() as $staff) {
            foreach ($days as $day) {
                StaffSchedule::create([
                    'staff_id'    => $staff->id,
                    'day_of_week' => $day,
                    'status'      => 'Working',
                    'start_time'  => '10:00:00',
                    'end_time'    => '20:00:00',
                    'branch'      => $staff->branch,
                ]);
            }
        }
    }
}
