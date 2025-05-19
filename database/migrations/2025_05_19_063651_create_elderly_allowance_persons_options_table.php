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
        Schema::create('elderly_allowance_persons_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ea_people_id')->constrained('elderly_allowance_people')->cascadeOnDelete();
            $table->string('welfare_type');
            $table->string('welfare_other_types')->nullable();
            $table->string('request_for_money_type');
            $table->string('document_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elderly_allowance_persons_options');
    }
};
