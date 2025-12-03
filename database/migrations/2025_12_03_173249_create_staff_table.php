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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();          // Senior Stylist, Makeup Artist, etc.
            $table->string('branch')->nullable();        // Banani, Dhanmondi, Gulshan (FR‑16).[file:1]
            $table->decimal('rating', 2, 1)->default(4.5);
            $table->enum('status', ['Active', 'On leave'])->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }

};
