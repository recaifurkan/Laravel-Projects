<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIletisimMesajsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iletisim_mesajs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('isim',40);
            $table->string('email',100);
            $table->string('konu',40);
            $table->string('mesaj',500);
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
        Schema::dropIfExists('iletisim_mesajs');
    }
}
