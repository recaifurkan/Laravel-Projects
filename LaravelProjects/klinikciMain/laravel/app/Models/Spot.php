<?php

namespace App\Models;

use App\Models\IpAdress;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    

    public function unite(){
        return $this->belongsTo('App\Models\Spot_unite', 'spot_unites_id', 'id');
        
    }

    public function hitArttir(){ // spotun hiti artırılacak bu işlem bu işi yapıyor
        $this->hit +=1;
        $kayit = $this->save();
        if($kayit){
            return true;
        }
        return false;

    }

    

    
    public function isIpBakti($ipadress){
        $anahtar = 'spot'.$this->id . $ipadress;
        if (Cache::has($anahtar)) {
           return true;
        }
        return false;
    }

    

    public function ipEkle($ipadress){ // spota ip adresi ekleniyor
        $anahtar = 'spot'.$this->id . $ipadress;
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

    //  public function isIpBakti($ipadress){// bu spota bakan var mı o kontol edliyor
    //    $ip = $this->bakanIpler()->where('ipadress',$ipadress)->first();

      
    // //    dd($ip);
    //     // dd($this->spotIpPivot->first()->pivot->request_hit);

    //     if($ip){
    //         $spotIpPivot = $this->spotIpPivot->first()->pivot;
    //         $spotIpPivot->request_hit+=1;
    //         $isKaydedildi =  $this->spotIpPivot->first()->pivot->save();
    //         // dd($isKaydedildi);
    //         if($isKaydedildi){
    //             return true;
    //         }

    //     }
    //     return false;
    // }



    // public function ipEkle($ipadress){ // spota ip adresi ekleniyor
    //     $ip = IpAdress::where('ipadress',$ipadress)->first();
    //    return $this->bakanIpler()->save($ip);
    // }

  
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
        
    }

    public function resimler(){
        return $this->hasMany('App\Models\Resim', 'spotlar_id', 'id');
    }

    public function yorumlar(){
        return $this->hasMany('App\Models\Spot_yorum', 'spotlar_id', 'id');
    }

    public function likedUsers(){
        return $this->belongsToMany('App\User', 'spot_users', 'spot_id', 'user_id');
        
    }

    public function bakanIpler(){
        return $this->belongsToMany('App\Models\IpAdress', 'spot_ipadresses', 'spot_id', 'ipadress_id');
        
    }

    public function spotIpPivot(){
        return $this->bakanIpler()->
        withPivot('id','spot_id','ipadress_id','request_hit');
    }


}
