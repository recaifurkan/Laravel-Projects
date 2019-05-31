<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHaberKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('haber_kategoris', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',120);
            $table->string('url',120);
            $table->string('aciklama',200);
           
            $table->unsignedInteger('haber_kategori_id');    
            $table->foreign('haber_kategori_id')
                ->references('id')
                ->on('haber_kategoris')
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
        Schema::dropIfExists('haber_kategoris');
    }
}
