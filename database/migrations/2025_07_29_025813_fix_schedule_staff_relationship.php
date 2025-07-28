<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('schedule', function (Blueprint $table) {
        // 1. Drop the foreign key using the exact name you provided
        $table->dropForeign('staff_schedules_staffid_foreign');
        
        // 2. Drop the unique index
        $table->dropUnique('staff_schedules_staffid_unique');
        
        // 3. Recreate the foreign key without unique constraint
        $table->foreign('staffID')
              ->references('staffID')
              ->on('staff')
              ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('schedule', function (Blueprint $table) {
        // For rollback
        $table->dropForeign(['staffID']);
        $table->unique('staffID', 'staff_schedules_staffid_unique');
        $table->foreign('staffID')
              ->references('staffID')
              ->on('staff')
              ->name('staff_schedules_staffid_foreign');
    });
}
};
