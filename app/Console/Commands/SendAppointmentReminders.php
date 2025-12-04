<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\NotificationLog;
use Carbon\Carbon;

/**
 * Prototype for FR‑19: automated SMS/Email reminders for upcoming appointments.[file:1]
 */
class SendAppointmentReminders extends Command
{
    protected $signature = 'ssbp:send-reminders';

    protected $description = 'Create reminder notification logs for bookings happening tomorrow';

    public function handle(): int
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $bookings = Booking::whereIn('status', ['Pending', 'Approved'])
            ->whereDate('date', $tomorrow)
            ->get();

        foreach ($bookings as $booking) {
            // Only log if we have a phone number
            if (!$booking->customer_phone) {
                continue;
            }

            NotificationLog::create([
                'booking_id' => $booking->id,
                'channel'    => 'SMS',
                'type'       => 'booking_reminder',
                'recipient'  => $booking->customer_phone,
                'message'    => "Reminder: your salon booking #{$booking->id} is scheduled for {$booking->date} at {$booking->time} ({$booking->branch}).",
            ]);
        }

        $this->info('Created reminders for '.$bookings->count().' bookings.');

        return Command::SUCCESS;
    }
}
