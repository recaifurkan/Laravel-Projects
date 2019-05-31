<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHaberYorumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('haber_yorums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icerik',400);
            $table->dateTime('yorum_tarihi');
            
            $table->integer('like');
            $table->integer('dislike');
            
           
            $table->unsignedInteger('ust_yorum_id');
            $table->foreign('ust_yorum_id')
                ->references('id')
                ->on('haber_yorums')
                ->onDelete('cascade');
            
            $table->unsignedInteger('user_id');    
            $table->foreign('user_id')
                ->references('id')
                ->on('uyes')
                ->onDelete('cascade');

            $table->unsignedInteger('haber_id');    
            $table->foreign('haber_id')
                ->references('id')
                ->on('habers')
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
        Schema::dropIfExists('haber_yorums');
    }
}
