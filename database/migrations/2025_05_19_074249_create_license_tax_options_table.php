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
        Schema::create('license_tax_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('license_tax_id')->constrained('license_tax_informations')->cascadeOnDelete();
            $table->integer('type')->nullable();
            $table->text('wide')->nullable();
            $table->text('long')->nullable();
            $table->text('meter')->nullable();
            $table->text('amount')->nullable();
            $table->text('text')->nullable();
            $table->text('place')->nullable();
            $table->date('date')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_tax_options');
    }
};
