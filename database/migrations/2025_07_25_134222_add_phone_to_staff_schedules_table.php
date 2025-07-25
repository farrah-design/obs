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
         Schema::table('staff', function (Blueprint $table) {
            // Add the new phone column
            $table->string('phone')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
      Schema::table('staff', function (Blueprint $table) {
            // Remove the column if rolling back
            $table->dropColumn('phone');
        });
    }
};
