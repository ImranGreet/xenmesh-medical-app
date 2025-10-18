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
        Schema::create('patient_admissions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('hospital_id')->constrained('hospital_infos')->onDelete('cascade');
            $table->foreignId('admitted_by_doctor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade'); // Changed from patient_room
            $table->foreignId('added_by')->constrained('users')->onDelete('cascade');

           
            $table->string('admission_id')->unique();
            $table->string('bed_number', 20)->nullable();
            $table->text('symptoms')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('admission_notes')->nullable();

            $table->dateTime('admission_date');
            $table->dateTime('discharge_date')->nullable();
            $table->dateTime('expected_discharge_date')->nullable();

            $table->enum('status', ['admitted', 'discharged', 'transferred', 'cancelled'])->default('admitted');
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_admissions');
    }
};
