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
        Schema::create('tax_refund_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', [1, 2]);
            $table->string('admin_name_verifier')->nullable();
            $table->string('salutation');
            $table->string('full_name')->nullable();
            $table->string('age')->nullable();
            $table->string('house_number')->nullable();
            $table->string('village')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->string('phone')->nullable();
            $table->string('tax_year')->nullable();
            $table->string('amount')->nullable();
            $table->string('receipt_number')->nullable();
            $table->date('dated')->nullable();
            $table->string('tax_money')->nullable();
            $table->string('due_to_options')->nullable();
            $table->string('other_documents')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_refund_requests');
    }
};
