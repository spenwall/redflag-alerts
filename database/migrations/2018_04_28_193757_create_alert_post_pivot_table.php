<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertPostPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alert_post', function (Blueprint $table) {
            $table->integer('alert_id')->unsigned()->index();
            $table->foreign('alert_id')->references('id')->on('alerts')->onDelete('cascade');
            $table->integer('post_id')->unsigned()->index();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->primary(['alert_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alert_post');
    }
}
