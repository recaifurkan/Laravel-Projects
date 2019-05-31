<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOzelMesajlarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ozel_mesajlars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('konu',120);
            $table->string('icerik',500);
            $table->boolean('goruldu');
            
            $table->dateTime('gonderilme_tarihi');
           
            $table->unsignedInteger('gonderen_user_id');
            $table->foreign('gonderen_user_id')
                ->references('id')->on('uyes');
                

            $table->unsignedInteger('gonderilen_user_id');
             $table->foreign('gonderilen_user_id')
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
        Schema::dropIfExists('ozel_mesajlars');
    }
}
