<?php

namespace App\Http\Controllers\admin\haber;

use App\Models\Haber;
use App\Models\Haber_yorum;
use Illuminate\Http\Request;
use App\Models\Haber_kategori;
use App\Http\Controllers\Controller;

class HaberGetController extends Controller
{
    public function kategoriler(){
        $kategoriler = Haber_kategori::all();

        return view('admin.haberler.goster.haber-kategoriler',[
            'kategoriler'=>$kategoriler]
    );
    }



    public function yorumlar($haberId){
        $yorumlar = Haber_yorum::where('haber_id',urldecode(trim($haberId)))->get();

        return view('admin.haberler.goster.haber-yorumlar',[
            'yorumlar'=>$yorumlar]);
    }

    public function haberler($kategoriId){
        // dd($kategoriId);
        $kategori = Haber_kategori::findOrFail(urldecode(trim($kategoriId)));
        $haberler = $kategori->haberler;
        
         
 

        return view('admin.haberler.goster.haber',[
            'kategori'=>$kategori,
            'haberler'=>$haberler]);

    }
    public function addHaber($kategoriId){
        $kategori = Haber_kategori::findOrFail(urldecode(trim($kategoriId)));
       

        return view('admin.haberler.ekle.haber-ekle',[
            'kategori'=>$kategori,
            
        ]);

    }
    public function editHaber($haberId){
        $haber = Haber::findOrFail(urldecode(trim($haberId)));
       

        return view('admin.haberler.edit.haber-duzenle',[
            'haber'=>$haber,
            
        ]);

    }
}
