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
        Schema::create('hospital_infos', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_name', 100);
            $table->string('code', 20)->unique();
            $table->string('address', 255)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('website')->nullable();
            $table->year('established_year')->nullable();
            $table->integer('number_of_beds')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('added_by_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_infos');
    }
};
