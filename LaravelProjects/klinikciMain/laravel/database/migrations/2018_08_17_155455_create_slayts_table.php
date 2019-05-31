<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlaytsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slayts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sira');
            $table->boolean('isaktif');
            $table->string('kisa_aciklama',100);
            $table->string('baslik',100);
           
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
        Schema::dropIfExists('slayts');
    }
}
