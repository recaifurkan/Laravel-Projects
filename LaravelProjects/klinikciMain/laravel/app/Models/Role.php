<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function uyeler(){
        return $this->belongsToMany('App\User', 'roles_users', 'users_id', 'roles_id');
}

}
