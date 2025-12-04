<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            // Basic schedule & availability info for FR‑11.[file:1]
            $table->string('shift_start')->nullable()->after('branch'); // e.g., "10:00 AM"
            $table->string('shift_end')->nullable()->after('shift_start'); // e.g., "08:00 PM"
            $table->string('weekly_off')->nullable()->after('shift_end'); // e.g., "Friday"
        });
    }

    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn(['shift_start', 'shift_end', 'weekly_off']);
        });
    }
};
