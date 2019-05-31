<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spot_ders extends Model
{
   

    public function kategori(){
        return $this->belongsTo('App\Models\Spot_kategori', 'spot_kategoriler_id', 'id');
        
    }

    public function resim(){
        return $this->hasOne('App\Models\Resim', 'spot_dersler_id', 'id');
    }

    public function uniteler(){
        return $this->hasMany('App\Models\Spot_unite', 'spot_dersler_id', 'id');
    }

    
}
