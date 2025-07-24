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
        Schema::create('feedback', function (Blueprint $table) {
            $table->string('feedbackID')->primary(); // Primary key
            $table->string('customerID'); // Foreign key
            $table->date('date');
            $table->tinyInteger('rating');  // Perfect for 1-5 stars
            $table->text('comment')->nullable(); // Feedback comment
            $table->timestamps(); // created_at and updated_at columns

            // Foreign Key Constraint
            $table->foreign('customerID')
                  ->references('customerID')
                  ->on('customers')
                  ->onDelete('cascade');
        });

    }

    
    public function down(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            // Drop foreign key first to avoid errors
            $table->dropForeign(['customerID']);
        });

        Schema::dropIfExists('feedback');
    }
};
