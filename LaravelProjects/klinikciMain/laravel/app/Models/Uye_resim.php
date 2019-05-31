<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uye_resim extends Model
{
    protected $table='user_resims';
    public function uye(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
