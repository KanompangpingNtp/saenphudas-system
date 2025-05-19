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
        Schema::create('child_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_information_id')->nullable()->constrained('child_information')->nullOnDelete();
            $table->foreignId('surrender_the_child_id')->nullable()->constrained('surrender_the_children')->nullOnDelete();
            $table->foreignId('child_registration_id')->nullable()->constrained('child_registrations')->nullOnDelete();
            $table->foreignId('users_id')->constrained('users')->cascadeOnDelete();
            $table->text('reply_text');
            $table->date('reply_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_replies');
    }
};
