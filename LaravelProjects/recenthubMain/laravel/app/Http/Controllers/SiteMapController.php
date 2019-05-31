<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Haber;
use App\Models\Kategori;
use Watson\Sitemap\Facades\Sitemap;

class SiteMapController extends Controller
{
   public function createSiteMap(){

    Sitemap::addTag(route('anasayfa'), Carbon::now(), 'daily', '0.8');
    
    Sitemap::addTag(route('contact'), Carbon::now(), 'daily', '0.8');
    Sitemap::addTag(route('privacy-policy'), Carbon::now(), 'daily', '0.8');
    // Sitemap::addTag(route('hakkimizda'), Carbon::now(), 'daily', '0.8');
   

    
    $this->getKategoriler();
    $this->getHaberler();
   

    return Sitemap::render();


   }

   public function getKategoriler(){
        $haberKategoriler = Kategori::all();
        foreach ($haberKategoriler as $kategori) {
            Sitemap::addTag(route('kategori-haberleri', ['kategori'=>$kategori->url]), $kategori->updated_At, 'daily', '0.8');
        }
   }

   public function getHaberler(){
        $haberler = Haber::where('eklenmeTarihi','<',Carbon::now())->get();
        foreach ($haberler as $haber) {
            Sitemap::addTag(route('haber', ['kategori'=>$haber->getKategori->url,'haber'=>$haber->url]), $haber->updated_At, 'daily', '0.8');
        } 
   }

  
}

