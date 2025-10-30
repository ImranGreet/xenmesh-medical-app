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
        Schema::create('cabins', function (Blueprint $table) {
            $table->id();
            $table->string('cabin_number')->unique(); 
            $table->string('type')->default('general'); 
            $table->unsignedInteger('floor_number')->nullable();
            $table->integer('bed_count')->default(1);
            $table->decimal('price_per_day', 10, 2)->default(0);
            $table->boolean('is_occupied')->default(false);
            // Relations
            $table->foreignId('patient_id')->nullable()->constrained('patients')->onDelete('set null');
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabins');
    }
};
