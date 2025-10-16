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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            // Personal Information
            $table->string('patient_name', 100);
            $table->unsignedTinyInteger('age'); // 0-255 range, perfect for age
            $table->enum('sex', ['male', 'female', 'other']);
            $table->date('date_of_birth')->nullable();
            $table->string('blood_group', 3)->nullable(); // A+, B-, O+, etc.

            // Contact Information
            $table->string('phone_number', 15);
            $table->string('email', 100)->nullable();
            $table->string('address', 255)->nullable();

            // Emergency Contact
            $table->string('emergency_contact_name', 100)->nullable();
            $table->string('emergency_contact_phone', 15)->nullable();

            // Medical Information
            $table->text('allergies')->nullable();
            $table->text('chronic_diseases')->nullable();

            // Foreign Keys
            $table->foreignId('hospital_id')->constrained('hospital_infos')->onDelete('cascade');
            $table->foreignId('added_by')->constrained('users')->onDelete('cascade');

            // Additional Fields
            $table->boolean('is_active')->default(true);
            $table->string('patient_id')->unique()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
