<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->string('serviceID')->primary();
            $table->string('serviceName');
            $table->decimal('price', 8, 2);
            $table->text('description')->nullable();
            $table->integer('duration'); // Duration in hour
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
        Schema::dropIfExists('services');
    }
};