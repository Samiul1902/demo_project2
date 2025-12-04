<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Customer;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Booking::query()->delete();

        $customer = Customer::first();
        $service  = Service::where('name', 'Classic Haircut')->first();

        if (!$customer || !$service) {
            return;
        }

        $today = Carbon::today();

        Booking::create([
            'service_id'     => $service->id,
            'branch'         => 'BANANI',
            // removed 'staff_name' because the column does not exist
            'customer_name'  => $customer->name,
            'customer_phone' => $customer->phone,
            'date'           => $today->toDateString(),
            'time'           => '16:00',
            'status'         => 'Pending',
            'total_price'    => $service->price,
        ]);
    }
}
