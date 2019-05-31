<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uyelik_seviye extends Model
{
    public function users(){
        return $this->hasMany('App\User', 'uyelik_seviye_id', 'id');
        
    }

    public function resimler(){
        return $this->hasMany('App\Models\Resim', 'uyelik_seviye_id', 'id');
        
    }
}