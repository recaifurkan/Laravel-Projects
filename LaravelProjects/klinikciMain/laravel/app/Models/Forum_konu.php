<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Forum_konu extends Model
{  

    public function hitArttir(){ // spotun hiti artırılacak bu işlem bu işi yapıyor
        $this->goruntulenme_sayisi +=1;
        $kayit = $this->save();
        if($kayit){
            return true;
        }
        return false;

    }

    public function ilkBakisIslem($ipadress){ // spota ilk baıldığında yapılavak işlemler belirlendi
        // $ipadress = Ipadress::where('ipadress',$ipadress)->first();
      
        if( $this->ipEkle($ipadress) // önce ip eklencek
         && $this->hitArttir() ){ // önceden bu ipdeki kişi bakmadığı için yani spota ilk baktığı için hiti arttırıldı
                return true;

        }
        return false;
       
        

    }

    public function isIpBakti($ipadress){
        $anahtar = 'forumKonu'.$this->id . $ipadress;
        if (Cache::has($anahtar)) {
           return true;
        }
        return false;
    }

    

    public function ipEkle($ipadress){ // habere ip adresi ekleniyor
        $anahtar = 'forumKonu'.$this->id . $ipadress;
        $sonuc = Cache::add($anahtar, 'true', $minutes=30);;
        // dd($sonuc);
        return $sonuc ;
     }

   

    // public function isIpBakti($ipadress){// bu foruma bakan var mı o kontol edliyor
    //     $ip = $this->bakanIpler()->where('ipadress',$ipadress)->first();
 
       
    //  //    dd($ip);
    //      // dd($this->spotIpPivot->first()->pivot->request_hit);
 
    //      if($ip){
             
    //              return true;
    //          }
 
        
    //      return false;
    //  }


    //  public function ipEkle($ipadress){ // spota ip adresi ekleniyor
    //     $ip = IpAdress::where('ipadress',$ipadress)->first();
    //    return $this->bakanIpler()->save($ip);
    // }













    


    public function likedUsers(){
        
        return $this->belongsToMany('App\User', 'konu_users', 'konu_id', 'user_id');
        
    }


    public function bakanIpler(){
        return $this->belongsToMany('App\Models\IpAdress', 'ipadress_forum_konus', 'forum_konu_id', 'ipadress_id');
       }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
        
    }

    public function kategori(){
        return $this->belongsTo('App\Models\Forum_konu_kategori', 'forum_konular_kategoriler_id', 'id');
        
    }




    public function resimler(){
        return $this->hasMany('App\Models\Resim', 'forum_konular_id', 'id');
    }

    

    public function mesajlar(){
        return $this->hasMany('App\Models\Forum_konu_mesaj', 'forum_konular_id', 'id');
    }

}