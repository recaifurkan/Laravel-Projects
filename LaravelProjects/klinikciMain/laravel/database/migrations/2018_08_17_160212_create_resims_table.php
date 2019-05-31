<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resims', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url',120);
            $table->string('aciklama',200);
            $table->boolean('ispublic');
            $table->boolean('isbuyuk');
           
            $table->unsignedInteger('buyuk_resim_id');
            $table->foreign('buyuk_resim_id')
                ->references('id')->on('resims')
                 ->onDelete('cascade');

            $table->unsignedInteger('slaytlar_id');
            $table->foreign('slaytlar_id')
                ->references('id')->on('slayts')
                 ->onDelete('cascade');

            $table->unsignedInteger('spot_kategoriler_id');
            $table->foreign('spot_kategoriler_id')
                ->references('id')->on('spot_kategoris')
                 ->onDelete('cascade');


            $table->unsignedInteger('spot_dersler_id');
            $table->foreign('spot_dersler_id')
                ->references('id')->on('spot_ders')
                 ->onDelete('cascade');

             $table->unsignedInteger('spotlar_id');
            $table->foreign('spotlar_id')
                ->references('id')->on('spots')
                 ->onDelete('cascade');

            $table->unsignedInteger('haber_kategori_id');
            $table->foreign('haber_kategori_id')
                ->references('id')->on('haber_kategoris')
                 ->onDelete('cascade');

            $table->unsignedInteger('haber_id');
            $table->foreign('haber_id')
                ->references('id')->on('habers')
                 ->onDelete('cascade');


            $table->unsignedInteger('uyelik_seviye_id');
            $table->foreign('uyelik_seviye_id')
                ->references('id')->on('uyelik_seviye_id')
                 ->onDelete('cascade');

            $table->unsignedInteger('forum_konular_id');
            $table->foreign('forum_konular_id')
                ->references('id')->on('forum_konus')
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
        Schema::dropIfExists('resims');
    }
}
