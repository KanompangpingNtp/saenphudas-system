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
        Schema::create('child_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_information_id')
                ->nullable()
                ->constrained('child_information')
                ->nullOnDelete();
            // $table->enum('status', ['1', '2']);
            // $table->string('admin_name_verifier')->nullable();
            $table->string('child_name')->nullable();
            $table->string('child_nickname')->nullable();
            $table->string('citizen_id')->nullable();
            $table->date('birthday')->nullable();
            $table->string('birth_province')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('house_number')->nullable();
            $table->string('village')->nullable();
            $table->string('alley_road')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->string('health_option')->nullable();
            $table->string('health_option_detail')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('congenital_disease')->nullable();
            $table->string('edited_by')->nullable();
            $table->string('drug_allergy')->nullable();
            $table->string('drug_allergy_detail')->nullable();
            $table->string('accident_history')->nullable();
            $table->string('accident_history_when_age');
            $table->string('ge_immunity')->nullable();
            $table->string('ge_immunity_detail')->nullable();
            $table->string('specially_about')->nullable();
            $table->string('the_eldest_son')->nullable();
            $table->string('number_of_siblings')->nullable();
            $table->string('elder_brother')->nullable();
            $table->string('younger_brother')->nullable();
            $table->string('elder_sister')->nullable();
            $table->string('younger_sister')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('fathers_age')->nullable();
            $table->string('fathers_occupation')->nullable();
            $table->string('fathers_workplace')->nullable();
            $table->string('fathers_phone')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_age')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_workplace')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_age')->nullable();
            $table->string('parent_relevant_as')->nullable();
            $table->string('parent_occupation')->nullable();
            $table->string('parent_workplace')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('alley')->nullable();
            $table->string('blood_group_detail')->nullable();
            $table->string('marital_status_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_registrations');
    }
};
