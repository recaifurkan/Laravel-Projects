<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ozel_mesajlar extends Model
{
    public function gonderen () {
       
        return $this->belongsTo('App\User', 'gonderen_user_id', 'id');
    }

    public function gonderilen () {
   
        return $this->belongsTo('App\User', 'gonderilen_user_id', 'id');
    }
}
