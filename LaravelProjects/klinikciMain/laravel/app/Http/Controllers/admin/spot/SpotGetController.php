<?php

namespace App\Http\Controllers\admin\spot;

use App\Models\Spot;
use App\Models\Spot_ders;
use App\Models\Spot_unite;
use App\Models\Spot_yorum;
use Illuminate\Http\Request;
use App\Models\Spot_kategori;
use App\Http\Controllers\Controller;

class SpotGetController extends Controller
{
    public function kategoriler(){
        $kategoriler = Spot_kategori::all();

        return view('admin.spotlar.goster.spot-kategoriler',[
            'kategoriler'=>$kategoriler]
    );
    }

    public function dersler($kategoriId){
        $kategori = Spot_kategori::findOrFail($kategoriId);
        $dersler = $kategori->dersler;
        // dd($dersler);

        return view('admin.spotlar.goster.spot-dersler',[
            'kategori'=>$kategori,
            'dersler'=>$dersler
            ]);
        
    }

    public function uniteler($dersId){
        $ders = Spot_ders::findOrFail($dersId);

        $uniteler = $ders->uniteler;

        return view('admin.spotlar.goster.spot-uniteler',[
            'ders'=>$ders,
            'uniteler'=>$uniteler]);
    }

    public function spotlar($uniteId){
        $unite = Spot_unite::findOrFail($uniteId);
        // dd($unite);
        $spotlar =$unite->spotlar;
        // dd($spotlar);

        return view('admin.spotlar.goster.spotlar',[
            'unite'=>$unite,
            'spotlar'=>$spotlar]);
    }

    public function yorumlar($spotId){
        $yorumlar = Spot_yorum::where('spotlar_id',urldecode(trim($spotId)))->get();

        return view('admin.spotlar.goster.spot-yorumlar',[
            'yorumlar'=>$yorumlar]);
        
    }

    public function editKategori($kategoriId){
        $kategori = Spot_kategori::where('id',urldecode(trim($kategoriId)))->first();

        return view('admin.spotlar.duzenle.kategori-duzenle',[
            'kategori'=>$kategori]
    );
    }



    

    public function editDers($dersId){
        $ders = Spot_ders::where('id',urldecode(trim($dersId)))->first();

        return view('admin.spotlar.duzenle.ders-duzenle',[
            'ders'=>$ders]
    );
    } 

    

    public function editUnite($uniteId){
        $unite = Spot_unite::where('id',urldecode(trim($uniteId)))->first();

        return view('admin.spotlar.duzenle.unite-duzenle',[
            'unite'=>$unite]
    );
    }

   

    public function editSpot($spotId){
        $spot = Spot::where('id',urldecode(trim($spotId)))->first();

        return view('admin.spotlar.duzenle.spot-duzenle',[
            'spot'=>$spot]
    );
    }

    public function addKategori(){
       

        return view('admin.spotlar.ekle.kategori-ekle');
    }



    

    public function addDers($kategoriId){
        $kategori= Spot_kategori::findOrFail($kategoriId);

       

        return view('admin.spotlar.ekle.ders-ekle',[
            'kategori'=>$kategori
        ]);
    } 

    

    public function addUnite($dersId){
        $ders=Spot_ders::findOrFail($dersId);


        return view('admin.spotlar.ekle.unite-ekle',[
            'ders'=>$ders
        ]);
    }

   

    public function addSpot($uniteId){
        $unite=Spot_unite::findOrFail($uniteId);
     

        return view('admin.spotlar.ekle.spot-ekle',[
            'unite'=>$unite
        ]);
    }


   
}
