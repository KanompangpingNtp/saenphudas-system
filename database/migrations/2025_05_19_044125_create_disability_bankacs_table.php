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
        Schema::create('disability_bankacs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disability_people_id')->constrained('disability_people')->onDelete('cascade');
            $table->string('bank_name');
            $table->string('bank_option');
            $table->string('account_number');
            $table->string('account_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disability_bankacs');
    }
};
