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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('business_id')->constrained('businesses')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('name')->nullable()->comment('Branch name');
        });

        Schema::create('branch_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('image_path')->nullable()->comment('Image path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
