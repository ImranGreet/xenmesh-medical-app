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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('doctor_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->enum('day', [
                'saturday',
                'sunday',
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
            ]);

            $table->time('from_time');
            $table->time('to_time');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
