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
        Schema::create('waste_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waste_management_id')->constrained('waste_management')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('payment_status')->nullable();
            $table->string('payment_slip')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('bill')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_payments');
    }
};
