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
        Schema::create('child_information', function (Blueprint $table) {
              $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['1', '2']);
            $table->string('admin_name_verifier')->nullable();
            $table->string('full_name');
            $table->string('ethnicity');
            $table->string('nationality')->nullable();
            $table->date('birthday')->nullable();
            $table->string('age')->nullable();
            $table->string('age_months')->nullable();
            $table->string('citizen_id')->nullable();
            $table->date('age_since_date')->nullable();
            $table->string('regis_house_number')->nullable();
            $table->string('regis_village')->nullable();
            $table->string('regis_road')->nullable();
            $table->string('regis_subdistrict')->nullable();
            $table->string('regis_district')->nullable();
            $table->string('regis_province')->nullable();
            $table->string('current_house_number')->nullable();
            $table->string('current_village')->nullable();
            $table->string('current_road')->nullable();
            $table->string('current_subdistrict')->nullable();
            $table->string('current_district')->nullable();
            $table->string('current_province')->nullable();
            $table->string('current_phone_number')->nullable();
            $table->string('number_of_siblings')->nullable();
            $table->string('congenital_disease')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('the_child_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_information');
    }
};
