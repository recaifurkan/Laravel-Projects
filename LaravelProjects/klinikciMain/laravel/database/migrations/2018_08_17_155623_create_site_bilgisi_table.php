<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteBilgisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_bilgisi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name',100);
            $table->string('site_keywords',250);
            $table->string('site_description',300);
            $table->string('site_author',120);
            $table->string('site_facebook',200);
            $table->string('site_twitter',200);
            $table->string('site_instagram',200);
            $table->string('site_gmail',200);
            
            $table->string('site_kisaca_bilgi',200);
            
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
        Schema::dropIfExists('site_bilgis');
    }
}
