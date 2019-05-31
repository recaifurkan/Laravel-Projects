<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('baslik',120);
            $table->string('icerik',900);
            $table->string('keywords',200);
            $table->dateTime('eklenme_tarihi');
            $table->integer('hit');
            $table->string('kisa_aciklama',120);
            $table->string('url',120);
           
            $table->unsignedInteger('haber_kategori_id');    
            $table->foreign('haber_kategori_id')
                ->references('id')
                ->on('haber_kategoris')
                ->onDelete('cascade');

            

            $table->unsignedInteger('user_id');    
            $table->foreign('user_id')
                    ->references('id')
                    ->on('uyeler')
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
        Schema::dropIfExists('habers');
    }
}
