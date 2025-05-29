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
        Schema::create('general_electricity_request_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', [1, 2]);
            $table->date('date');
            $table->string('subject')->nullable();
            $table->string('salutation')->nullable();
            $table->string('name')->nullable();
            $table->integer('age')->nullable();
            $table->string('phone')->nullable();
            $table->string('house_number')->nullable();
            $table->string('village')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->text('request_details')->nullable();
            $table->string('admin_name_verifier')->nullable();
            $table->string('included')->nullable();
            $table->string('proceedings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_electricity_request_forms');
    }
};
