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
        Schema::create('disability_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disability_people_id')->constrained('disability_people')->onDelete('cascade');
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
        Schema::dropIfExists('disability_options');
    }
};
