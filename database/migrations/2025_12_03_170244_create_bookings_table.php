<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Link to service (FR‑3: select service).[file:1]
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();

            // For now store customer name/phone directly (before auth).
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();

            $table->string('branch');
            $table->date('date');
            $table->string('time'); // simple string like "10:00 AM"

            $table->string('stylist_preference')->nullable();

            $table->text('notes')->nullable();

            // Pending/Approved/Rejected/Completed for admin module (FR‑12, FR‑13).[file:1]
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Completed'])
                  ->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
