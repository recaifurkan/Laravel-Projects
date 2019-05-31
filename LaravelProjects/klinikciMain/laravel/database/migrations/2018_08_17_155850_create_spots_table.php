<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icerik', 400);
            $table->string('url',150);
            $table->string('keywords',200);
            $table->integer('like');
            $table->integer('dislike');
            $table->dateTime('eklenme_tarihi');
            $table->integer('hit');
            
            $table->unsignedInteger('spot_unites_id');
            $table->foreign('spot_unites_id')
                ->references('id')->on('spot_unites')
                 ->onDelete('cascade');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('uyes')
                 ->onDelete('cascade');

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
        Schema::dropIfExists('spots');
    }
}
