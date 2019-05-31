<?php

namespace App\Models;
use App\Models\Resim;

use Illuminate\Database\Eloquent\Model;

class Slayt extends Model
{
    

    public function resim(){
        return $this->hasOne('App\Models\Resim', 'slaytlar_id', 'id');
    }

    

    
}
