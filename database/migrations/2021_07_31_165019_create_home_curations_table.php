<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeCurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_curations', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id')->nullable();
            $table->string('cat_code')->nullable();
            $table->integer('service_id')->nullable();
            $table->string('name')->nullable();
            $table->string('name_bn')->nullable();
            $table->tinyInteger('show_app')->default(1);
            $table->tinyInteger('show_web')->default(1);
            $table->integer('item_limit')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('sort_order')->nullable();
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
        Schema::dropIfExists('home_curations');
    }
}
