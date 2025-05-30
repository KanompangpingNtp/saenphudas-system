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
        Schema::create('food_storage_explore_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('informations_id')->constrained('food_storage_informations')->onDelete('cascade');
            $table->text('detail')->nullable();
            $table->text('price')->nullable();
            $table->text('file')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_storage_explore_logs');
    }
};
