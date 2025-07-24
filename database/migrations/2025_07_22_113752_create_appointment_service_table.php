<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('appointment_service', function (Blueprint $table) {
    $table->string('appointmentID');
    $table->string('serviceID');
    $table->string('serviceNotes')->nullable();
    $table->timestamps();

    $table->primary(['appointmentID', 'serviceID']);

    $table->foreign('appointmentID')->references('appointmentID')->on('appointments')->onDelete('cascade');
    $table->foreign('serviceID')->references('serviceID')->on('services')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_service');
    }
};
