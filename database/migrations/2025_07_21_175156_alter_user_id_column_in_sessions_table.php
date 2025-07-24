<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserIdColumnInSessionsTable extends Migration
{
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Change user_id column to string (from integer)
            $table->string('user_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            // Rollback: Change user_id back to integer
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }
}
