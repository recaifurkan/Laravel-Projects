<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sinav extends Model
{
    public function uye(){
        return $this->hasOne('App\User', 'sinavlar_id', 'id');
    }
}
