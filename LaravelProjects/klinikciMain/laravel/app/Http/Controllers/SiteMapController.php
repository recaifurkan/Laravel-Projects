<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Spot;
use App\Models\Haber;
use App\Models\Spot_ders;
use App\Models\Forum_konu;
use App\Models\Spot_unite;
use Illuminate\Http\Request;
use App\Models\Haber_kategori;
use App\Models\Forum_konu_kategori;
use Watson\Sitemap\Facades\Sitemap;

class SiteMapController extends Controller
{
   public function createSiteMap(){

    Sitemap::addTag(route('home'), Carbon::now(), 'daily', '0.8');
    Sitemap::addTag(route('anasayfa'), Carbon::now(), 'daily', '0.8');
    Sitemap::addTag(route('iletisim'), Carbon::now(), 'daily', '0.8');
    // Sitemap::addTag(route('hakkimizda'), Carbon::now(), 'daily', '0.8');
    Sitemap::addTag(route('haber-anasayfa'), Carbon::now(), 'daily', '0.8');
    Sitemap::addTag(route('spot-anasayfa'), Carbon::now(), 'daily', '0.8');
    Sitemap::addTag(route('forum-anasayfa'), Carbon::now(), 'daily', '0.8');

    
    $this->getHaberKategoriler();
    $this->getHaberler();
    $this->getForumKategoriler();
    $this->getForumKonular();
    $this->getSpotDersler();
    $this->getSpotDersUniteler();
    $this->getSpotlar();
    $this->getSpot();

    return Sitemap::render();


   }

   public function getHaberKategoriler(){
        $haberKategoriler = Haber_kategori::all();
        foreach ($haberKategoriler as $kategori) {
            Sitemap::addTag(route('kategori-haberler', ['kategori'=>$kategori->url]), $kategori->updated_At, 'daily', '0.8');
        }
   }

   public function getHaberler(){
        $haberler = Haber::all();
        foreach ($haberler as $haber) {
            Sitemap::addTag(route('haber', ['kategori'=>$haber->kategori->url,'haber'=>$haber->url]), $haber->updated_At, 'daily', '0.8');
        }
   }

   public function getForumKategoriler(){
        $forumKategoriler = Forum_konu_kategori::all();
        foreach ($forumKategoriler as $kategori) {
            Sitemap::addTag(route('kategori-konular',['kategori'=>$kategori->url]), $kategori->updated_At, 'daily', '0.8');
        }
   }

   public function getForumKonular(){
        $forumKonular = Forum_konu::all();
        foreach ($forumKonular as $konu) {
            Sitemap::addTag(route('konu', ['kategori'=>$konu->kategori->url,'konu'=>$konu->url]), $konu->updated_At, 'daily', '0.8');
        }
   }

   

   public function getSpotDersler(){
        $spotDersler = Spot_ders::all();
        foreach ($spotDersler as $ders) {
            Sitemap::addTag(route('spot-dersler', ['kategori'=>$ders->kategori->url]), $ders->updated_At, 'daily', '0.8');
        }
   }
   public function getSpotDersUniteler(){
        $spotUniteler = Spot_unite::all();
        // dd($spotUniteler);
        foreach ($spotUniteler as $unite) {
            Sitemap::addTag(route('spot-uniteler', [
                'kategori'=>$unite->ders->kategori->url,
                'ders'=>$unite->ders->url]), $unite->updated_At, 'daily', '0.8');
        }
   }
   public function getSpotlar(){
        $spotlar = Spot::all();
        foreach ($spotlar as $spot) {
            Sitemap::addTag(route('unite-spotlar',  [
                'kategori'=> $spot->unite->ders->kategori->url,
                'ders'=>$spot->unite->ders->url,
                'unite'=>$spot->unite->url]),$spot->updated_At, 'daily', '0.8');
        }

   }

   public function getSpot(){
    $spotlar = Spot::all();
    foreach ($spotlar as $spot) {
        Sitemap::addTag(route('spot', [
            'kategori'=> $spot->unite->ders->kategori->url,
            'ders'=>$spot->unite->ders->url,
            'unite'=>$spot->unite->url,
            'spot'=>$spot->url]),$spot->updated_At, 'daily', '0.8');
    }

   }
}

