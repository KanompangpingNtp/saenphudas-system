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
        Schema::table('food_storage_explore_logs', function (Blueprint $table) {
            $table->string('business_type')->nullable();
            $table->string('inspection_type')->nullable();
            $table->string('name_establishment')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('location')->nullable();
            $table->string('village')->nullable();
            $table->string('alley')->nullable();
            $table->string('road')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('characteristics_options')->nullable();
            $table->string('characteristics_floor')->nullable();
            $table->string('characteristics_floor_no')->nullable();
            $table->string('characteristics_area')->nullable();
            $table->string('sanitary_option1')->nullable();
            $table->string('sanitary_option2')->nullable();
            $table->string('sanitary_option2_detail')->nullable();
            $table->string('sanitary_option3')->nullable();
            $table->string('sanitary_option4')->nullable();
            $table->string('sanitary_option5')->nullable();
            $table->string('sanitary_option6')->nullable();
            $table->string('sanitary_option7')->nullable();
            $table->string('sanitary_option8')->nullable();
            $table->string('sanitary_option9')->nullable();
            $table->string('sanitary_option10')->nullable();
            $table->string('sanitary_option11')->nullable();
            $table->string('food_handlers')->nullable();
            $table->string('cook')->nullable();
            $table->string('server')->nullable();
            $table->string('health_check_option')->nullable();
            $table->string('dressing_option')->nullable();
            $table->string('training_option')->nullable();
            $table->string('extinguisher_option')->nullable();
            // $table->string('results_option')->nullable();
            $table->string('results_option_details')->nullable();
            // $table->string('recommendations')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food_storage_explore_logs', function (Blueprint $table) {
            $table->dropColumn([
                'business_type',
                'inspection_type',
                'name_establishment',
                'location',
                'village',
                'alley',
                'road',
                'subdistrict',
                'district',
                'province',
                'phone',
                'fax',
                'characteristics_options',
                'characteristics_floor',
                'characteristics_floor_no',
                'characteristics_area',
                'sanitary_option1',
                'sanitary_option2',
                'sanitary_option2_detail',
                'sanitary_option3',
                'sanitary_option4',
                'sanitary_option5',
                'sanitary_option6',
                'sanitary_option7',
                'sanitary_option8',
                'sanitary_option9',
                'sanitary_option10',
                'sanitary_option11',
                'food_handlers',
                'cook',
                'server',
                'health_check_option',
                'dressing_option',
                'training_option',
                'extinguisher_option',
                // 'results_option',
                'results_option_details',
                // 'recommendations'
            ]);
        });
    }
};
