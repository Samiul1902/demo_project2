<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();

            // Optional link to a booking, to keep feedback tied to an appointment (FR‑7).[file:1]
            $table->foreignId('booking_id')->nullable()
                  ->constrained('bookings')
                  ->nullOnDelete();

            $table->string('customer_name');
            $table->string('customer_phone')->nullable();

            // Simple rating 1–5 stars.
            $table->unsignedTinyInteger('rating')->nullable();

            // Free-text comments from customer.
            $table->text('comments')->nullable();

            // Target of feedback: service, staff, overall.
            $table->string('target_type')->default('service'); // 'service','staff','overall'
            $table->string('target_name')->nullable();          // e.g. service name or staff name

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
