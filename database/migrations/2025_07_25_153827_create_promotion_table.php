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
        Schema::create('promotion', function (Blueprint $table) {
            $table->string('promoID')->primary(); // Custom primary key
            $table->string('staffID'); // Staff who created the promotion
            $table->string('title');
            $table->text('description');
            $table->date('validUntil');
            $table->decimal('discountPrice', 8, 2); // Allows prices up to 999,999.99
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('staffID')
                  ->references('staffID')
                  ->on('staff')
                  ->onDelete('cascade');

            $table->unique(['promoID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotion', function (Blueprint $table) {
            $table->dropForeign(['staffID']); // Drop foreign key first
        });
        
        Schema::dropIfExists('promotion');
    }
};
