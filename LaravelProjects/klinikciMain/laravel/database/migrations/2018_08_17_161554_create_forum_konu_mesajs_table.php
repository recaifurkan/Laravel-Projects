<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumKonuMesajsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_konu_mesajs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icerik',500);
            $table->boolean('mesaj_onay');
            $table->dateTime('yazilma_tarihi');
            $table->unsignedInteger('forum_konular_id');
            $table->foreign('forum_konular_id')
                ->references('id')
                ->on('forum_konu_mesajs')
                ->onDelete('cascade');
            $table->unsignedInteger('user_id');    
            $table->foreign('user_id')
                ->references('id')
                ->on('uyes')
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
        Schema::dropIfExists('forum_konu_mesajs');
    }
}
