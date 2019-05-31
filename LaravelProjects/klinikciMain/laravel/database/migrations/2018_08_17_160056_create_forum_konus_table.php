<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumKonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_konus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',120);
            $table->string('url',120);
            $table->string('keywords',200);
            $table->boolean('isaktif');
            $table->dateTime('acilis_tarihi');
            $table->string('aciklama',250);
            $table->integer('goruntulenme_sayisi');
            $table->integer('begenilme_sayisi');
            $table->unsignedInteger('forum_konular_kategoriler_id');
            $table->foreign('forum_konular_kategoriler_id')
                ->references('id')
                ->on('forum_konu_kotegoris')
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
        Schema::dropIfExists('forum_konus');
    }
}
