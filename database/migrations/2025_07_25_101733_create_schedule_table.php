<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_schedules', function (Blueprint $table) {
            $table->string('scheduleID')->primary(); // Custom primary key
            $table->string('staffID');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['available', 'unavailable', 'off-day'])->default('available');
            $table->timestamps();
            
            $table->foreign('staffID')
                  ->references('staffID') // Make sure this is the correct column name in staff table
                  ->on('staff') // Make sure this is your staff table name
                  ->onDelete('cascade');

            // Remove unique constraint to allow multiple schedules per staff
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_schedules');
    }
};
