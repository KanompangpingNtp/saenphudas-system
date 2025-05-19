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
        Schema::create('elderly_allowance_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['1', '2']);
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
            $table->string('community')->nullable();
            $table->string('alley')->nullable();
            $table->string('road')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('citizen_id')->nullable();
            $table->enum('marital_status', ['single', 'married', 'widowed', 'divorced', 'separated', 'other']);
            $table->string('monthly_income')->nullable();
            $table->string('occupation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elderly_allowance_people');
    }
};
