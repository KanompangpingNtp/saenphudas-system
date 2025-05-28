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
        Schema::create('food_storage_form_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('informations_id')->constrained('food_storage_informations')->onDelete('cascade');
            $table->string('confirm_option')->nullable();
            $table->string('confirm_volume')->nullable();
            $table->string('confirm_number')->nullable();
            $table->string('confirm_year')->nullable();
            $table->date('confirm_expiration_date')->nullable();
            $table->string('place_name')->nullable();
            $table->string('shop_type')->nullable();
            $table->string('location')->nullable();
            $table->string('details_village')->nullable();
            $table->string('details_alley')->nullable();
            $table->string('details_road')->nullable();
            $table->string('details_subdistrict')->nullable();
            $table->string('details_district')->nullable();
            $table->string('details_province')->nullable();
            $table->string('details_telephone');
            $table->string('details_fax')->nullable();
            $table->string('business_area')->nullable();
            $table->string('number_of_cooks')->nullable();
            $table->string('number_of_food')->nullable();
            $table->string('including_food_handlers')->nullable();
            $table->string('number_of_trainees')->nullable();
            $table->string('opening_hours')->nullable();
            $table->string('opening_for_business_until')->nullable();
            $table->string('total_hours')->nullable();
            $table->string('document_option')->nullable();
            $table->string('document_option_detail')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_storage_form_details');
    }
};
