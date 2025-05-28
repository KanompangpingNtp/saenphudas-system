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
        Schema::create('private_markets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('form_status', [1, 2]);
            $table->string('written_at')->nullable();
            $table->string('salutation')->nullable();
            $table->string('full_name')->nullable();
            $table->string('age')->nullable();
            $table->string('force')->nullable();
            $table->string('house_number')->nullable();
            $table->string('road')->nullable();
            $table->string('village')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->string('submit_request')->nullable();
            $table->string('submit_road')->nullable();
            $table->string('submit_number')->nullable();
            $table->string('submit_sub_district')->nullable();
            $table->string('submit_district')->nullable();
            $table->string('submit_province')->nullable();
            $table->string('annual_market')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_markets');
    }
};
