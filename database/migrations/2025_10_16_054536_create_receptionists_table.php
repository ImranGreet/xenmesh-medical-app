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
        Schema::create('receptionists', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name', 100);
            $table->unsignedTinyInteger('age');
            $table->enum('sex', ['male', 'female', 'other']);
            $table->date('date_of_birth')->nullable();
            $table->string('blood_group', 3)->nullable();
            $table->string('phone_number', 15);
            $table->string('email', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('emergency_contact_name', 100)->nullable();
            $table->string('emergency_contact_phone', 15)->nullable();
            $table->string('allergies', 255)->nullable();
            $table->string('chronic_diseases', 255)->nullable();

            // Foreign keys
            $table->foreignId('hospital_id')
                ->constrained('hospital_infos')
                ->onDelete('cascade');

            $table->foreignId('added_by')
                ->constrained('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receptionists');
    }
};
