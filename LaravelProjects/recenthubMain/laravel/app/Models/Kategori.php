<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoriler';

    public function getUstKategori(){
        return $this->belongsTo('App\Models\Kategori', 'ustKategoriId', 'id');
    }
    public function getAltKategoriler(){
        return $this->hasMany('App\Models\Kategori', 'ustKategoriId', 'id');
    }

    public function getHaberler(){
        return $this->hasMany('App\Models\Haber', 'kategoriId', 'id');
    }


}
