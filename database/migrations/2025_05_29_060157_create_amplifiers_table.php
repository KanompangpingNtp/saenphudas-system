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
        Schema::create('amplifiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('form_status', [1, 2]);
            $table->string('status')->nullable();
            $table->string('admin_name_verifier')->nullable();
            $table->string('written_at')->nullable();
            $table->string('full_name')->nullable();
            $table->string('age')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('nationality')->nullable();
            $table->string('house_number')->nullable();
            $table->string('road')->nullable();
            $table->string('village')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->string('registration_number1')->nullable();
            $table->string('registration_number2')->nullable();
            $table->string('registration_number3')->nullable();
            $table->string('have_intention')->nullable();
            $table->string('location_at')->nullable();
            $table->string('location_number')->nullable();
            $table->string('location_road')->nullable();
            $table->string('location_village')->nullable();
            $table->string('location_sub_district')->nullable();
            $table->string('location_district')->nullable();
            $table->string('location_province')->nullable();
            $table->string('location_set')->nullable();
            $table->string('location_start')->nullable();
            $table->string('location_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amplifiers');
    }
};
