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
        Schema::create('disability_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->nullable();
            $table->string('admin_name_verifier')->nullable();
            $table->string('written_at');
            $table->date('written_date');
            $table->string('salutation');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_day')->nullable();
            $table->integer('age')->nullable();
            $table->string('nationality')->nullable();
            $table->string('house_number')->nullable();
            $table->string('village')->nullable();
            $table->string('alley')->nullable();
            $table->string('road')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('citizen_id')->nullable();
            $table->string('type_of_disability')->nullable();
            $table->enum('marital_status', ['single', 'married', 'widowed', 'divorced', 'separated', 'other'])->nullable();
            $table->string('monthly_income')->nullable();
            $table->string('occupation')->nullable();
            $table->string('references_contacted')->nullable();
            $table->string('references_phone')->nullable();
            $table->string('community')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disability_people');
    }
};
