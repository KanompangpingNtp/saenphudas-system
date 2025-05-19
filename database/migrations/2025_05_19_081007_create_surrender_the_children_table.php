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
        Schema::create('surrender_the_children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_information_id')
                ->nullable()
                ->constrained('child_information')
                ->nullOnDelete();
            $table->string('full_name')->nullable();
            $table->string('age')->nullable();
            $table->string('occupation')->nullable();
            $table->string('income')->nullable();
            $table->string('village')->nullable();
            $table->string('alley_road')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('district')->nullable();
            $table->string('province')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('childs_name')->nullable();
            $table->string('contact_location')->nullable();
            $table->string('salutation')->nullable();
            $table->string('child_recipient')->nullable();
            $table->string('child_recipient_relevant')->nullable();
            $table->string('child_recipient_phone')->nullable();
            $table->string('hour_number')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('child_recipient_related')->nullable();
            $table->string('child_recipient_salutation')->nullable();
            $table->string('child_surrender_salutation')->nullable();
            $table->string('child_surrender_salutation1')->nullable();
            $table->string('child_salutation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surrender_the_children');
    }
};
