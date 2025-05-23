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
        Schema::create('waste_management', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->nullable();
            $table->string('admin_name_verifier')->nullable();
            $table->string('salutation');
            $table->string('name');
            $table->string('address');
            $table->string('village');
            $table->string('sub_district');
            $table->string('district');
            $table->string('province');
            $table->string('phone');
            $table->string('optione');
            $table->text('optione_detail');
            $table->string('lat');
            $table->string('lng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_management');
    }
};
