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
        Schema::create('working_week_days', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('day', ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'])->default('sun')->comment('Working Day');
            $table->boolean('status')->default(0);
        });

        Schema::create('working_week_day_times', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('working_week_day_id')->constrained('working_week_days')->cascadeOnDelete()->cascadeOnUpdate();
            $table->time('start_time')->nullable()->comment('Working Start time');
            $table->time('end_time')->nullable()->comment('Working End time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_week_day_times');
        Schema::dropIfExists('working_week_days');
    }
};
