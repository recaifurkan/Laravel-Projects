<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spot_kategori extends Model
{
    public function resim(){
        return $this->hasOne('App\Models\Resim', 'spot_kategoriler_id', 'id');
    }

    public function dersler(){
        return $this->hasMany('App\Models\Spot_ders', 'spot_kategoriler_id', 'id');
    }
}
