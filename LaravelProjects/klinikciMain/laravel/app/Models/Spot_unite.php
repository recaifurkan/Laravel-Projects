<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spot_unite extends Model
{
    public function ders(){
        return $this->belongsTo('App\Models\Spot_ders', 'spot_dersler_id', 'id');
        
    }

    public function spotlar(){
        return $this->hasMany('App\Models\Spot', 'spot_unites_id', 'id');
    }
}
