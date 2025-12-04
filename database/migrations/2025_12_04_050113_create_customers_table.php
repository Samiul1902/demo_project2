<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            // Basic profile information (FR‑1: name, contact, preferences).[file:1]
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->nullable()->unique();

            // Simple preference fields used by booking (preferred branch/time).
            $table->string('preferred_branch')->nullable();
            $table->string('preferred_stylist')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
