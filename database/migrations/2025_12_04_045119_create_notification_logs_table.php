<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();

            // Link to booking so admins can trace which appointment triggered it (FR‑8).[file:1]
            $table->foreignId('booking_id')
                  ->nullable()
                  ->constrained('bookings')
                  ->nullOnDelete();

            // Channel the system intended to use: SMS or Email.
            $table->string('channel')->default('SMS'); // 'SMS' or 'Email'

            // Short type code, e.g. booking_created, booking_cancelled, booking_approved.
            $table->string('type');

            // Recipient info (phone or email).
            $table->string('recipient')->nullable();

            // Human-readable message body that would be sent.
            $table->text('message');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
    }
};
