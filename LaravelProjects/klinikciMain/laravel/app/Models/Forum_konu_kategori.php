<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum_konu_kategori extends Model
{
    public function konular(){
        return $this->hasMany('App\Models\Forum_konu', 'forum_konular_kategoriler_id', 'id');
    }

    public function altKategoriler(){
        return $this->hasMany('App\Models\Forum_konu_kategori', 'ustkategori_id', 'id');
    }


    public function ustKategori(){
        return $this->belongsTo('App\Models\Forum_konu_kategori', 'ustkategori_id', 'id');
        
    }
}
