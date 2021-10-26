<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('telco');
            $table->integer('showitem');
            $table->integer('showinapp');
            $table->integer('sortorder');
            $table->string('cat_code');
            $table->string('cat_name_bn');
            $table->string('cat_name');
            $table->integer('content_type');
            $table->integer('item_type');
            $table->integer('content_view_type');
            $table->integer('contents');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('home_page_settings');
    }
}
