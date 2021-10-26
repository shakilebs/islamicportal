<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudioContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_contents', function (Blueprint $table) {
            $table->id();
            $table->string('content_id');
            $table->integer('cat_id');
            $table->integer('service_id');
            $table->string('file_name');
            $table->string('content_title');
            $table->string('content_title_bn');
            $table->string('content_type');
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
        Schema::dropIfExists('audio_contents');
    }
}
