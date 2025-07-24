<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->string('appointmentID')->primary(); // Custom primary key
            $table->string('customerID'); // Assuming it's a string (e.g. UUID or username)
            $table->date('date');
            $table->time('time');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

           // Foreign Key Constraint
            $table->foreign('customerID')
                  ->references('customerID')
                  ->on('customers')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
