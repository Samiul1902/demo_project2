<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Simple integer points earned from this booking (FR‑15/FR‑20).[file:1]
            $table->unsignedInteger('loyalty_points')
                  ->default(0)
                  ->after('total_price');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('loyalty_points');
        });
    }
};
