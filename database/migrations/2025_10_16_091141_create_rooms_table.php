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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('hospital_id')->constrained('hospital_infos')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Room Information
            $table->string('room_number', 20);
            $table->string('room_type', 50)->nullable();
            $table->string('floor', 10)->nullable();
            $table->string('wing', 10)->nullable();

            // Capacity & Availability
            $table->unsignedSmallInteger('total_beds');
            $table->unsignedSmallInteger('available_beds');
            $table->decimal('price_per_day', 10, 2)->nullable();

            // Facilities
            $table->json('facilities')->nullable();
            $table->text('description')->nullable();

            // Status
            $table->boolean('is_available')->default(true);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
