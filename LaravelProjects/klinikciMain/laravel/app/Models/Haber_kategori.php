<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Haber_kategori extends Model
{
    public function resimler(){
        return $this->hasMany('App\Models\Resim', 'haber_kategori_id', 'id');
    }

    public function haberler(){
        return $this->hasMany('App\Models\Haber', 'haber_kategori_id', 'id');
    }

    public function altkategoriler(){
        return $this->hasMany('App\Models\Haber_kategori', 'haber_kategori_id', 'id');
    }

    public function ustKategori(){
        return $this->belongsTo('App\Models\Haber_kategori', 'haber_kategori_id', 'id');
        
    }
}
