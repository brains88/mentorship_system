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
        Schema::table('mentorships', function (Blueprint $table) {
            $table->date('appointment_date')->nullable();
            $table->time('appointment_time')->nullable();
            $table->time('end_time')->nullable();
        });
    }

    public function down()
    {
        Schema::table('mentorships', function (Blueprint $table) {
            $table->dropColumn(['appointment_date', 'appointment_time']);
        });
    }

};