<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum_konu_mesaj extends Model
{
    public function user () {
       
            return $this->belongsTo('App\User', 'user_id', 'id');
        }

    public function konu () {
       
            return $this->belongsTo('App\Models\Forum_konu', 'forum_konular_id', 'id');
        }

        public function likedUsers(){
        
            return $this->belongsToMany('App\User', 'user_konu_mesajs', 'forum_konu_id', 'user_id');
            
        }
    
}
