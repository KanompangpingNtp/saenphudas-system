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
        Schema::create('assist_impartings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assist_people_id')->constrained('assist_people')->onDelete('cascade');
            $table->string('accommodation')->nullable();
            $table->string('accommodation_belongs_to')->nullable();
            $table->string('accommodation_relevant_as')->nullable();
            $table->string('away_from_home')->nullable();
            $table->string('away_from_home_option')->nullable();
            $table->string('away_from_home_option_dueto')->nullable();
            $table->string('away_from_community')->nullable();
            $table->string('away_from_community_option')->nullable();
            $table->string('away_from_community_option_dueto')->nullable();
            $table->string('stay_away_from_agency')->nullable();
            $table->string('stay_away_from_agency_option')->nullable();
            $table->string('stay_away_from_agency_option_dueto')->nullable();
            $table->string('residence')->nullable();
            $table->string('residence_stay_alone_dueto')->nullable();
            $table->string('residence_stay_alone_dueto_detail')->nullable();
            $table->string('residence_living_with')->nullable();
            $table->string('residence_living_with_detail')->nullable();
            $table->string('residence_living_with_quantity')->nullable();
            $table->string('residence_living_with_working')->nullable();
            $table->string('residence_living_with_total_income')->nullable();
            $table->string('residence_living_with_non_workers')->nullable();
            $table->string('total_income')->nullable();
            $table->string('source_of_income')->nullable();
            $table->string('used_for_expenses')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_address_number')->nullable();
            $table->string('contact_road')->nullable();
            $table->string('contact_alley')->nullable();
            $table->string('contact_village')->nullable();
            $table->string('contact_subdistrict')->nullable();
            $table->string('contact_district')->nullable();
            $table->string('contact_province')->nullable();
            $table->string('contact_postal_code')->nullable();
            $table->string('contact_telephone')->nullable();
            $table->string('contact_fax')->nullable();
            $table->string('contact_relevant_as')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assist_impartings');
    }
};
