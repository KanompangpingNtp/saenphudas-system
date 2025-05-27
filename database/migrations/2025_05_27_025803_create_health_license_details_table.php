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
        Schema::create('health_license_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_license_id')->constrained('health_license_apps')->onDelete('cascade');
            $table->string('type_request')->nullable();
            $table->string('petition')->nullable();
            $table->string('name_establishment')->nullable();
            $table->string('location')->nullable();
            $table->string('details_village')->nullable();
            $table->string('details_alley')->nullable();
            $table->string('details_road')->nullable();
            $table->string('details_subdistrict')->nullable();
            $table->string('details_district')->nullable();
            $table->string('details_province')->nullable();
            $table->string('details_telephone')->nullable();
            $table->string('details_fax')->nullable();
            $table->string('business_area')->nullable();
            $table->string('machine_power')->nullable();
            $table->string('number_male_workers')->nullable();
            $table->string('number_female_workers')->nullable();
            $table->string('opening_hours')->nullable();
            $table->string('opening_for_business_until')->nullable();
            $table->string('document_option')->nullable();
            $table->string('document_option_detail')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_license_details');
    }
};
