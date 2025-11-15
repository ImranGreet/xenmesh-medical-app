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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('department_id')->constrained('departments');
            $table->enum('gender', ['male', 'female']);
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->string('specialization')->nullable();
            $table->string('qualification')->nullable();
            $table->integer('experience_years')->nullable();
            $table->decimal('appointment_fees')->nullable();

            $table->foreignId('hospital_id')
                ->constrained('hospital_infos')
                ->onDelete('cascade');
                
            $table->foreignId('added_by_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};


