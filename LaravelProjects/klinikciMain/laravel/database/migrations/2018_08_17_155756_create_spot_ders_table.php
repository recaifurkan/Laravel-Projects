<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpotDersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spot_ders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('aciklama',200);
            $table->string('url',120);
            
            $table->unsignedInteger('spot_kategoriler_id');

            $table->foreign('spot_kategoriler_id')
                ->references('id')
                ->on('spot_kategoris')
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
        Schema::dropIfExists('spot_ders');
    }
}
