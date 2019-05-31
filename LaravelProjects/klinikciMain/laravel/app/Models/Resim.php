<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Resim extends Model
{
    

    
    public function slayt(){

        
        return $this->belongsTo('App\Models\Slayt', 'slaytlar_id', 'id');
        
    }

    public function spotKategori(){
        return $this->belongsTo('App\Models\Spot_kategori', 'spot_kategoriler_id', 'id');
        
    }

    public function spotDers(){
        return $this->belongsTo('App\Models\Spot_ders', 'spot_dersler_id', 'id');
        
    }

    public function spot(){
        return $this->belongsTo('App\Models\Spot', 'spotlar_id', 'id');
        
    }

    public function haberKategori(){
        return $this->belongsTo('App\Models\Haber_kategori', 'haber_kategori_id', 'id');
        
    }

    public function haber(){
        return $this->belongsTo('App\Models\Haber', 'haber_id', 'id');
        
    }

    public function uyelikSeviye(){
        return $this->belongsTo('App\Models\Uyelik_seviye', 'uyelik_seviye_id', 'id');
        
    }

    public function forumKonu(){
        return $this->belongsTo('App\Models\Forum_konu', 'forum_konular_id', 'id');
        
    }

    public function buyukResim(){
        return $this->belongsTo('App\Models\Resim', 'buyuk_resim_id', 'id');
    }

    public function kucukResim(){
        return $this->hasO('App\Models\Resim', 'buyuk_resim_id', 'id');
    }

    
}
