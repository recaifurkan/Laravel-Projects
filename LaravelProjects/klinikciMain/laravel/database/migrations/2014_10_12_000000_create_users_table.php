<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',60);
            $table->string('email',100)->unique();
            $table->string('password',60);
            $table->string('soyad',60)->nullable();
            $table->dateTime('uyelik_tarihi')->nullable();
            $table->string('kullanici_adi',60)->unique();
            
            
            $table->boolean('uyelik_isdonuk')->nullable();
            
            $table->boolean('uye_isbanlandi')->nullable();
            
            
            $table->unsignedInteger('uyelik_seviye_id')->nullable();
            $table->foreign('uyelik_seviye_id')
                ->references('id')->on('uyelik_seviyes')
                 ->onDelete('cascade')->nullable();

            $table->unsignedInteger('sinavlar_id')->nullable();
            $table->foreign('sinavlar_id')
                ->references('id')->on('sinavs')
                 ->onDelete('cascade');


            $table->unsignedInteger('profil_resim_id')->nullable();
            $table->foreign('profil_resim_id')
                     ->references('id')->on('uye_resims')
                      ->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
