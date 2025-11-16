<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name', 100);
            $table->unsignedTinyInteger('age');
            $table->enum('sex', ['male', 'female']);
            $table->date('date_of_birth')->nullable();
            $table->string('blood_group', 3)->nullable();
            $table->boolean('is_admitted')->default(false);
            $table->string('phone_number', 15);
            $table->string('email', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('emergency_contact_phone', 15)->nullable();
            $table->boolean('keep_records')->default(false)->nullable();

            $table->text('allergies')->nullable();
            $table->text('chronic_diseases')->nullable();

            $table->foreignId('hospital_id')->constrained('hospital_infos')->onDelete('cascade');
            $table->foreignId('added_by_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->string('generated_patient_id')->unique();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
