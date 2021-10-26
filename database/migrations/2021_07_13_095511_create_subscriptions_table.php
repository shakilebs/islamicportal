<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('sort_order');
            $table->string('service_name');
            $table->tinyInteger('special_offer');
            $table->string('sub_pack');
            $table->string('sub_pack_name');
            $table->string('pack_duration');
            $table->string('pack_name');
            $table->tinyInteger('is_free');
            $table->tinyInteger('is_sep');
            $table->string('sub_text');
            $table->string('sub_details');
            $table->string('reg_msg');
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
        Schema::dropIfExists('subscriptions');
    }
}
