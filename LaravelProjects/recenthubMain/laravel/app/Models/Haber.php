<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;

class Haber extends Model
{
    protected $table = 'news';

    public function getKategori(){

        return $this->belongsTo('App\Models\Kategori', 'kategoriId', 'id');

    }
    public function getYazar(){
        return $this->belongsTo('App\User', 'yazarId', 'id');
    }

    public function hitArttir(){ // spotun hiti artırılacak bu işlem bu işi yapıyor
        $this->hit +=1;
        $kayit = $this->update();
        // dd($thiss->hit); 
        if($kayit){
            return true;
        }
        return false;

    }

    

    
    public function isIpBakti($ipadress){
        // dd($this->hit);
        $anahtar = 'new'.$this->id . $ipadress;
        if (Cache::has($anahtar)) {
           return true;
        }
        return false;
    }

    

    public function ipEkle($ipadress){ // spota ip adresi ekleniyor
        $anahtar = 'new'.$this->id . $ipadress;
        
        $sonuc = Cache::add($anahtar, 'true', $minutes=30);;
        // dd($sonuc);
        return $sonuc ;
     }

     public function hitIslem($ipadress){ // spota ilk baıldığında yapılavak işlemler belirlendi
        // $ipadress = Ipadress::where('ipadress',$ipadress)->first();
        // dd($this->hit);
        if(!$this->isIpBakti($ipadress)){ //önce ip eklencek
            $this->ipEkle($ipadress); // önceden bu ipdeki kişi bakmadığı için yani spota ilk baktığı için hiti arttırıldı
            $this->hitArttir();
            return true;
            

        }
        
        return false;
       
        

    }

    
    public function getResim($boyut,$add = false){
        if($add){
            switch ($boyut) {
                case '550x330':
                // dd($boyut);
                    return $this->belongsTo('App\Models\Resim', '550x330Id', 'id');
                    break;
                case '300x215':
                    return $this->belongsTo('App\Models\Resim', '300x215Id', 'id');
                break;
                case '390x240':
                    return $this->belongsTo('App\Models\Resim', '390x240Id', 'id');
                break;
                case '112x112':
                    return $this->belongsTo('App\Models\Resim', '112x112Id', 'id');
                break;
                case '75x75':
                    return $this->belongsTo('App\Models\Resim', '75x75Id', 'id');
                break;
                
            }

        }
        else{
            switch ($boyut) {
                case '550x330':
                // dd($boyut);
                    return $this->belongsTo('App\Models\Resim', '550x330Id', 'id')->first();
                    break;
                case '300x215':
                    return $this->belongsTo('App\Models\Resim', '300x215Id', 'id')->first();
                break;
                case '390x240':
                    return $this->belongsTo('App\Models\Resim', '390x240Id', 'id')->first();
                break;
                case '112x112':
                    return $this->belongsTo('App\Models\Resim', '112x112Id', 'id')->first();
                break;
                case '75x75':
                    return $this->belongsTo('App\Models\Resim', '75x75Id', 'id')->first();
                break;
                
            }
        }
        

        
    }

    public function getAllResim(){
        $resimler = [];
        $resimler[] = $this->getResim('550x330');
        $resimler[] = $this->getResim('300x215');
        $resimler[] = $this->getResim('390x240');
        $resimler[] = $this->getResim('112x112');
        $resimler[] = $this->getResim('75x75');
        // dd($resimler);
        return $resimler;


    }
    


}
