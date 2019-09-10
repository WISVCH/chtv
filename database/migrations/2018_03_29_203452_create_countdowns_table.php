<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countdowns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('slide_id');
            $table->text("header")->nullable();
            $table->text("description_left")->nullable();
            $table->text("description_right")->nullable();
            $table->text("countdown_done")->nullable();
            $table->integer("countdown_type")->default(1);
            $table->dateTime("deadline");
            $table->string("background")->nullable();

            $table->foreign('slide_id')->references('id')->on('slides');
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
        Schema::dropIfExists('countdowns');
    }
}
