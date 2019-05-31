<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUyeResimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_resims', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url',120);
            $table->boolean('ispublic');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('uyes')
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
        Schema::dropIfExists('uye_resims');
    }
}
