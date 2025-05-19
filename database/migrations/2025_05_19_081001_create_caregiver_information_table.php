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
        Schema::create('caregiver_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_information_id')->constrained('child_information')->cascadeOnDelete();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('edu_qual_father')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('edu_qual_mother')->nullable();
            $table->string('care_option')->nullable();
            $table->string('care_option_other')->nullable();
            $table->string('caretaker_income')->nullable();
            $table->string('applicants_name')->nullable();
            $table->string('applicants_relevant')->nullable();
            $table->string('child_carrier_name')->nullable();
            $table->string('child_carrier_relevant')->nullable();
            $table->string('child_carrier_phone')->nullable();
            $table->string('care_option_relative_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caregiver_information');
    }
};
