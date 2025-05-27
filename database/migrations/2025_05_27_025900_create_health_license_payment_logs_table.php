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
        Schema::create('health_license_payment_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_license_id')->constrained('health_license_apps')->onDelete('cascade');
            $table->text('receipt_book')->nullable();
            $table->text('receipt_number')->nullable();
            $table->text('file')->nullable();
            $table->text('file_treasury')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_license_payment_logs');
    }
};
