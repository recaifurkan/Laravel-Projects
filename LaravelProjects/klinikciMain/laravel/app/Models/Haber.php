<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Haber extends Model
{
    public function kategori(){
        return $this->belongsTo('App\Models\Haber_kategori', 'haber_kategori_id', 'id');
        
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
        
    }

   public function kapakResim(){
       return $this->hasOne('App\Models\Resim', 'kapakResim_id', 'id');
      
   }
    
    
    
    
    public function resimler(){
        return $this->hasMany('App\Models\Resim', 'haber_id', 'id');
    }

    public function resim(){
        return  $this->resimler->first();
    }

    

    public function yorumlar(){
        return $this->hasMany('App\Models\Haber_yorum', 'haber_id', 'id');
    }

    
    public function hitArttir(){ // haberin hiti artırılacak bu işlem bu işi yapıyor
        $this->hit +=1;
        $kayit = $this->save();
        if($kayit){
            return true;
        }
        return false;

    }

    

    
    public function isIpBakti($ipadress){
        $anahtar = 'haber'.$this->id . $ipadress;
        if (Cache::has($anahtar)) {
           return true;
        }
        return false;
    }

    

    public function ipEkle($ipadress){ // habere ip adresi ekleniyor
        $anahtar = 'haber'.$this->id . $ipadress;
        $sonuc = Cache::add($anahtar, 'true', $minutes=30);;
        // dd($sonuc);
        return $sonuc ;
     }

     public function ilkBakisIslem($ipadress){ // spota ilk baıldığında yapılavak işlemler belirlendi
        // $ipadress = Ipadress::where('ipadress',$ipadress)->first();
      
        if( $this->ipEkle($ipadress) // önce ip eklencek
         && $this->hitArttir() ){ // önceden bu ipdeki kişi bakmadığı için yani spota ilk baktığı için hiti arttırıldı
                return true;

        }
        return false;
       
        

    }

}
