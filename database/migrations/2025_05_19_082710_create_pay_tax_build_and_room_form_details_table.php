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
        Schema::create('pay_tax_build_and_room_form_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pay_tax_id')->constrained('pay_tax_build_and_room_informations')->cascadeOnDelete();
            $table->text('personal_salutation')->nullable();
            $table->text('personal_full_name')->nullable();
            $table->text('personal_age')->nullable();
            $table->text('personal_id_card_number')->nullable();
            $table->text('personal_id_card_by')->nullable();
            $table->date('personal_id_card_date')->nullable();
            $table->text('personal_address')->nullable();
            $table->text('personal_village')->nullable();
            $table->text('personal_alley')->nullable();
            $table->text('personal_road')->nullable();
            $table->text('personal_subdistrict')->nullable();
            $table->text('personal_district')->nullable();
            $table->text('personal_province')->nullable();
            $table->text('personal_telephone')->nullable();
            $table->text('personal_line')->nullable();
            $table->text('personal_email')->nullable();
            $table->text('org_salutation')->nullable();
            $table->text('org_full_name')->nullable();
            $table->text('org_address')->nullable();
            $table->text('org_village')->nullable();
            $table->text('org_alley')->nullable();
            $table->text('org_road')->nullable();
            $table->text('org_subdistrict')->nullable();
            $table->text('org_district')->nullable();
            $table->text('org_province')->nullable();
            $table->text('org_telephone')->nullable();
            $table->text('org_salutation_2')->nullable();
            $table->text('org_full_name_2')->nullable();
            $table->text('org_age_2')->nullable();
            $table->text('org_id_card_2')->nullable();
            $table->text('org_id_card_by_2')->nullable();
            $table->date('org_id_card_date_2')->nullable();
            $table->text('org_certificate')->nullable();
            $table->date('org_certificate_date')->nullable();
            $table->text('org_line')->nullable();
            $table->text('org_email')->nullable();
            $table->text('year')->nullable();
            $table->text('date')->nullable();
            $table->integer('total')->nullable();
            $table->text('round_date_1')->nullable();
            $table->integer('round_total_1')->nullable();
            $table->text('round_date_2')->nullable();
            $table->integer('round_total_2')->nullable();
            $table->text('round_date_3')->nullable();
            $table->integer('round_total_3')->nullable();
            $table->integer('confirm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_tax_build_and_room_form_details');
    }
};
