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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('status')->default('Pending');
            $table->decimal('appointment_fee', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->string('reason')->nullable();
            $table->string('room_number')->nullable();
            $table->integer('duration')->default(30);
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('appointed_doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('added_by_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
