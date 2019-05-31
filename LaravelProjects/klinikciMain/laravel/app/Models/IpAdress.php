<?php

namespace App\Models;


use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class IpAdress extends Model
{
    public $timestamps = true;

   protected $fillable = ['ipadress'];

   
     
   function ip($ipadress){
       $this->ipadress = $ipadress; 
    }

   public function users(){
    return $this->belongsToMany('App\User', 'user_ipadresses', 'ipadress_id', 'user_id');
   }

   public function spots(){
    return $this->belongsToMany('App\Models\Spot', 'spot_ipadresses', 'ipadress_id', 'spot_id');
   }

   public function konular(){
    return $this->belongsToMany('App\Models\Forum_konu', 'ipadress_forum_konus', 'ipadress_id', 'forum_konu_id');
   }

    public function isCacheIpBakti(){
        $anahtar = 'siteMesaj' .$this->ipadress;
        if (Cache::has($anahtar)) {
           return true;
        }
        return false;
    }

    

    public function ipCacheEkle(){ // spota ip adresi ekleniyor
        $anahtar = 'siteMesaj'. $this->ipadress;
        $sonuc = Cache::add($anahtar, 'true', $minutes=5);;
        // dd($sonuc);
        return $sonuc ;
     }


   public function ipEkle($ipadress){
    $this->ipadress=$ipadress;

    $kayit=$this->save();
    if($kayit){
        return true;
    }
    return false;

   }

   public function hitArttir(){
       $this->request_hit +=1;
    //    $this->updated_at=Carbon::now();
        $updated = $this->save();
        // dd($updated);
   }

   
}
