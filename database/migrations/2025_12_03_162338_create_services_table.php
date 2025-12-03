<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Basic service info
            $table->string('name');
            $table->string('category')->nullable();          // Hair / Skin / Makeup / Spa etc.

            // Booking-related attributes
            $table->unsignedInteger('duration')->default(30); // Minutes required for the service
            $table->unsignedInteger('price')->default(0);     // Price in BDT as per SRS.[file:1]

            // Branch & status (for multi-branch FR‑16).[file:1]
            $table->string('branch')->nullable();             // Banani, Dhanmondi, Gulshan...
            $table->enum('status', ['Active', 'Inactive'])->default('Active');

            // Description shown on service detail page
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
