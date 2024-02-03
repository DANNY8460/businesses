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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable()->comment('Business Name');
            $table->string('email')->nullable()->comment('Business Email');
            $table->string('phone_number')->nullable()->comment('Business Number');
            $table->string('logo_path')->nullable()->comment('Business Logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
