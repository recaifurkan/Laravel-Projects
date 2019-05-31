<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spot_yorum extends Model
{
    protected $fillable = ['icerik','like','dislike','ust_yorum_id','spotlar_id','user_id'];

    public function spot(){
        return $this->belongsTo('App\Models\Spot', 'spotlar_id', 'id');
        
    }
    

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
        
    }


    public function altYorumlar(){
        return $this->hasMany('App\Models\Spot_yorum', 'ust_yorum_id', 'id');
        
    }

    public function ustYorum(){
        return $this->belongsTo('App\Models\Spot_yorum', 'ust_yorum_id', 'id');
        
    }


    
}
