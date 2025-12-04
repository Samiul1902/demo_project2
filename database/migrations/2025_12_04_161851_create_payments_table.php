<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Link to booking so each payment belongs to one appointment (FR‑22).[file:1]
            $table->foreignId('booking_id')
                  ->constrained('bookings')
                  ->cascadeOnDelete();

            // SSLCommerz transaction values.
            $table->string('store_id')->nullable();
            $table->string('tran_id')->unique();     // merchant transaction id
            $table->string('currency', 10)->default('BDT');
            $table->decimal('amount', 12, 2);

            // Status from gateway: INITIATED, SUCCESS, FAILED, CANCELLED.
            $table->string('status')->default('INITIATED');

            // Raw gateway data for debugging / audit.
            $table->json('gateway_payload')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
