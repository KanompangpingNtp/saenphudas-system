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
        Schema::create('license_tax_form_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('license_tax_id')->constrained('license_tax_informations')->cascadeOnDelete();
            $table->text('salutation')->nullable();
            $table->text('full_name')->nullable();
            $table->text('build_name')->nullable();
            $table->text('address')->nullable();
            $table->text('alley')->nullable();
            $table->text('village')->nullable();
            $table->text('road')->nullable();
            $table->text('subdistrict')->nullable();
            $table->text('district')->nullable();
            $table->text('province')->nullable();
            $table->text('telephone')->nullable();
            $table->text('emp_fullname')->nullable();
            $table->text('build_wide_1')->nullable();
            $table->text('build_long_1')->nullable();
            $table->text('build_meter_1')->nullable();
            $table->text('build_amount_1')->nullable();
            $table->text('build_text_1')->nullable();
            $table->text('build_place_1')->nullable();
            $table->date('build_date_1')->nullable();
            $table->text('build_remark_1')->nullable();
            $table->text('build_wide_2')->nullable();
            $table->text('build_long_2')->nullable();
            $table->text('build_meter_2')->nullable();
            $table->text('build_amount_2')->nullable();
            $table->text('build_text_2')->nullable();
            $table->text('build_place_2')->nullable();
            $table->date('build_date_2')->nullable();
            $table->text('build_remark_2')->nullable();
            $table->text('build_wide_3')->nullable();
            $table->text('build_long_3')->nullable();
            $table->text('build_meter_3')->nullable();
            $table->text('build_amount_3')->nullable();
            $table->text('build_text_3')->nullable();
            $table->text('build_place_3')->nullable();
            $table->date('build_date_3')->nullable();
            $table->text('build_remark_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_tax_form_details');
    }
};
