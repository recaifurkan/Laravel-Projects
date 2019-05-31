<?php

namespace App\Http\Controllers\Admin;

use App\Models\Haber;
use App\Models\Resim;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetController extends Controller
{
    public function getAdminAnasayfa(){
      
        return view('admin.anasayfa');

    }

    public function getHaberKategoriler(){
 
        $kategoriler = Kategori::all();

        return view('admin.haberler.goster.haber-kategoriler',[
            'kategoriler'=>$kategoriler]);

    }

    public function getHaberler($kategoriId){
        // dd($kategoriId);
        $kategori = Kategori::findOrFail(urldecode(trim($kategoriId)));
        // dd($kategori);
        $haberler = $kategori->getHaberler;
        // dd($haberler);
        
         
 

        return view('admin.haberler.goster.haber',[
            'kategori'=>$kategori,
            'haberler'=>$haberler]);

    }

    public function addHaber($kategoriId){
        $kategori = Kategori::findOrFail(urldecode(trim($kategoriId)));
        $haberler = Haber::all();
        $kategoriler = Kategori::all();
       

        return view('admin.haberler.ekle.haber-ekle',[
            'kategori'=>$kategori,
            'haberler'=>$haberler,
            'kategoriler'=>$kategoriler,
            
        ]);

    }

    public function editHaber($haberId){
        $haber = Haber::findOrFail(urldecode(trim($haberId)));
    //    dd($haber);

        return view('admin.haberler.edit.haber-duzenle',[
            'haber'=>$haber,
            
        ]);

    }
}
