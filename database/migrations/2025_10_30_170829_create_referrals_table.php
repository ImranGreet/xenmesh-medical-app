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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('from_doctor_id');
            $table->foreignId('to_doctor_id');
            $table->foreignId('department_id')->nullable();
            $table->text('reason')->nullable();
            $table->enum('urgency', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['pending', 'scheduled', 'completed'])->default('pending');
            $table->foreignId('appointment_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
