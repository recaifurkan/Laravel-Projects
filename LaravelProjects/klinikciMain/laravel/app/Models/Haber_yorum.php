<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Haber_yorum extends Model
{
    public function haber(){
        return $this->belongsTo('App\Models\Haber', 'haber_id', 'id');
        
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
        
    }

    public function ustYorum(){
        return $this->belongsTo('App\Models\Haber_yorum', 'ust_yorum_id', 'id');
        
    }

    public function altYorumlar(){
        return $this->hasMany('App\Models\Haber_yorum', 'ust_yorum_id', 'id');
        
    }
}
