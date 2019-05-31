<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumKonuKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_konu_kategoris', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name',120);
            $table->string('url',100);
            $table->unsignedInteger('ustkategori_id');
            $table->foreign('ustkategori_id')->references('id')->on('forum_konu_kategoris')->onDelete('cascade');
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
        Schema::dropIfExists('forum_konu_kategoris');
    }
}
