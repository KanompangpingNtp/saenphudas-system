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
        Schema::create('change_in_use_form_details', function (Blueprint $table) {
            $table->id();
            $table->integer('change_in_use_id');
            $table->text('land_total')->nullable();
            $table->text('land_on')->nullable();
            $table->text('land_village')->nullable();
            $table->text('land_road')->nullable();
            $table->text('land_subdistrict')->nullable();
            $table->text('land_district')->nullable();
            $table->text('land_province')->nullable();
            $table->text('land_deed')->nullable();
            $table->text('land_rai')->nullable();
            $table->text('land_unit')->nullable();
            $table->text('land_wa')->nullable();
            $table->text('land_default_use')->nullable();
            $table->text('land_current_use')->nullable();
            $table->date('land_current_date')->nullable();
            $table->text('build_total')->nullable();
            $table->text('build_on')->nullable();
            $table->text('build_village')->nullable();
            $table->text('build_road')->nullable();
            $table->text('build_subdistrict')->nullable();
            $table->text('build_district')->nullable();
            $table->text('build_province')->nullable();
            $table->text('build_deed')->nullable();
            $table->text('build_meter')->nullable();
            $table->text('build_default_use')->nullable();
            $table->text('build_current_use')->nullable();
            $table->date('build_current_date')->nullable();
            $table->text('room_total')->nullable();
            $table->text('room_name')->nullable();
            $table->text('room_on')->nullable();
            $table->text('room_village')->nullable();
            $table->text('room_road')->nullable();
            $table->text('room_subdistrict')->nullable();
            $table->text('room_district')->nullable();
            $table->text('room_province')->nullable();
            $table->text('room_deed')->nullable();
            $table->text('room_meter')->nullable();
            $table->text('room_default_use')->nullable();
            $table->text('room_current_use')->nullable();
            $table->date('room_current_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('change_in_use_form_details');
    }
};
