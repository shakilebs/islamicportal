<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalatTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salat_times', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('year');
            $table->string('day_name');
            $table->string('day_name_bn');
            $table->string('seheri');
            $table->string('iftar');
            $table->string('fajr');
            $table->string('dhuhr');
            $table->string('asr');
            $table->string('maghrib');
            $table->string('isha');
            $table->string('sunset');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salat_times');
    }
}
