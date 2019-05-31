<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpotYorumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spot_yorums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icerik',400);
            $table->dateTime('eklenme_tarih');
            $table->integer('like');
            $table->integer('dislike');

            $table->unsignedInteger('ust_yorum_id');
            $table->foreign('ust_yorum_id')
                ->references('id')->on('spot_yorums')
                 ->onDelete('cascade');

            $table->unsignedInteger('spotlar_id');
            $table->foreign('spotlar_id')
                ->references('id')->on('spots')
                 ->onDelete('cascade');

            $table->unsignedInteger('user_id');
             $table->foreign('user_id')
                    ->references('id')->on('uyes');

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
        Schema::dropIfExists('spot_yorums');
    }
}
