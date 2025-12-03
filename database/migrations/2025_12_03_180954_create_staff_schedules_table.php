<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_schedules', function (Blueprint $table) {
            $table->id();

            // Link to staff member (FR‑11: manage staff schedules).[file:1]
            $table->foreignId('staff_id')->constrained('staff')->cascadeOnDelete();

            // Day of week: 0=Sunday ... 6=Saturday
            $table->unsignedTinyInteger('day_of_week');

            // Working / Off flag
            $table->enum('status', ['Working', 'Off'])->default('Working');

            // Working hours for that day (24h time stored as string for simplicity)
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            // Optional branch override if a stylist works in multiple branches
            $table->string('branch')->nullable();

            $table->timestamps();

            $table->unique(['staff_id', 'day_of_week']); // one record per day per staff
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_schedules');
    }
};
