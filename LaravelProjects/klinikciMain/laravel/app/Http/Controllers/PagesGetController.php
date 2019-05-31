<?php

namespace App\Http\Controllers;
use DB;

use App\User;
use Response;
use App\Models\Spot;
use App\Models\Haber;
use App\Models\Sinav;
use App\Models\Slayt;
use App\Models\IpAdress;
use App\Models\Spot_ders;
use App\Models\Forum_konu;
use App\Models\Spot_unite;
use Illuminate\Http\Request;
use App\Models\Spot_kategori;
use App\Models\Haber_kategori;
use App\Models\Forum_konu_kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PageController;

class PagesGetController extends PageController
{
    public function getHome()
    {

        $sliderler = Slayt::where('isaktif',1)->orderBy('sira', 'asc')->get();
        // $haberler = Haber::where('haberOnay',1)->orderBy('eklenme_tarihi', 'desc')->limit(4)->get();
        // $dersUnite=null;
        // $dersUniteler = [];
        while(!isset($dersUnite)){
            $spotDersler = Spot_ders::orderByRaw("RAND()")->limit(2)->get();
            foreach ($spotDersler as $spotDers) {
                 $dersUnite= $spotDers->uniteler()->orderByRaw("RAND()")->first();
                 if(isset($dersUnite)){
                     continue;

                 }
                // $spotlar = [];
                // $dersUnite= $spotDers->uniteler()->orderByRaw("RAND()")->first();
                // $uniteSpotlari=$dersUnite->spotlar()->orderBy('hit', 'desc')->limit(6)->get();
                // array_push($spotlar,$uniteSpotlari);
                // array_push($dersUniteler,$spotlar);
                // array_push($dersUniteler,$dersUnite);
            }
           
           
           
        }
       
       
        
        // echo $dersUnite->name;
       
        
       
        
        
       


        $enSonAcilanKonular = Forum_konu::orderBy('acilis_tarihi', 'desc')->limit(10)->get();
        // foreach ($enSonAcilanKonular as $konu) {
        //     dd($konu->kategori);
        // }
        $enCokBegenilenKonular = Forum_konu::orderBy('begenilme_sayisi', 'desc')->limit(10)->get();
        $sinavlar = Sinav::all();

        return  view('anasayfa')->with([
            'sliderler' => $sliderler,
            // 'haberler' => $haberler,
           
            'spotDersler' =>  $spotDersler,
            'enSonAcilanKonular' => $enSonAcilanKonular,
            'enCokBegenilenKonular' => $enCokBegenilenKonular,
            'sinavlar' => $sinavlar,
        ]);
    }

    public function getIletisim(Request $request)
    {  $banned = null;
        if(isset($request->banned))
              $banned = $request->banned;
            //   dd($banned);
        return view('iletisim')->with([
            'banned'=> $banned
        ]);
    }

    public function getHakkimizda()
    {
        return view('hakkimizda');
    }

    public function getHaberlerAnasayfa()  {
    
   
    

       
    


    $haberKategoriler = Haber_kategori::orderByRaw("RAND()")->limit(5)->get();
    $enSonHaberler = Haber::where('haberOnay',1)->orderBy('eklenme_tarihi', 'desc')->limit(6)->get();
    $haberler = Haber::where('haberOnay',1)->paginate(10);


  
        return view('haberler',[
            'haberKategoriler'=>$haberKategoriler,
            'enSonHaberler'=>$enSonHaberler,
            'haberler'=>$haberler


        ]);
    }

    public function haberKategori($kategori)  {
    
        
            $kategori=Haber_kategori::where(DB::raw("TRIM(url)"),trim(urldecode($kategori)))->first();
            if(!$kategori){
                abort(404);
            }
            
            $haberler = $kategori->haberler()->where('haberOnay',1)->paginate(10);
            
        
       
    
    
        $haberKategoriler = Haber_kategori::orderByRaw("RAND()")->limit(5)->get();
        $enSonHaberler = Haber::where('haberOnay',1)->orderBy('eklenme_tarihi', 'desc')->limit(6)->get();
       
    
    
      
            return view('haberler',[
                'haberKategoriler'=>$haberKategoriler,
                'enSonHaberler'=>$enSonHaberler,
                'haberler'=>$haberler,
                'kategori'=>$kategori
    
    
            ]);
        }
    public function haber($kategori,$haber,Request $request)
    {
        $haber=Haber::where(DB::raw("TRIM(url)"),trim(urldecode($haber)))->where('haberOnay',1)->first();
        if(!$haber){
            abort(404);
        }
        try{
            $yorumlar=$haber->yorumlar()->orderBy('yorum_tarihi','desc')->get();
        }
        catch (Illuminate\Database\QueryException $e){
           
            }
       
        $haberKategoriler = Haber_kategori::orderByRaw("RAND()")->limit(5)->get();
        $enSonHaberler = Haber::where('haberOnay',1)->orderBy('eklenme_tarihi', 'desc')->limit(6)->get();
        if(!$haber->isIpBakti($request->ip())){// bu ip adresi bu spota baktı mı kontrol ediliyor
            // bakmamışsa ip adresi kaydedilip spotun hiti arttılıyor.
        
        
        $haber->ilkBakisIslem($request->ip()); // spota ilk bakılmada yapılacak işlemler belirlendi

        }



        return view('haber-tek',[
            'haberKategoriler'=>$haberKategoriler,
            'enSonHaberler'=>$enSonHaberler,
            'haber'=>$haber,
            'yorumlar'=>$yorumlar
           


        ]);
    }





    public function spotBilgilerAnasayfa()
    {
        $kategoriler = Spot_kategori::all();
        foreach ($kategoriler as $kategori) {
        //    dd($kategori->resimler[0]->url);
        }
       // dd(getAllSpots($kategoriler));


        return view('spot-bilgiler-anasayfa')->with('kategoriler',$kategoriler);
    }
    public function spotBilgilerDers($kategori)
    {
        $kategori=Spot_kategori::where(DB::raw("TRIM(url)"),trim(urldecode($kategori)))->first();
        if(!$kategori){
            abort(404);
        }
        
        $dersler=$kategori->dersler()->paginate(5);
        //  dd($dersler->first());

        return view('spot-bilgiler-ders')->with([
            'dersler'=>$dersler,
            'kategori'=>$kategori
            
            ]);
    }
    public function spotBilgiDersKonu($kategoti, $ders)
    {
        $ders=Spot_ders::where(DB::raw("TRIM(url)"),trim(urldecode($ders)))->first();
        if(!$ders){
            abort(404);
        }
        // dd($ders);
        $konular=$ders->uniteler()->paginate(15);
        // dd($konular);


        return view('spot-bilgi-ders-konu')->with([
            'konular'=>$konular,
            'ders'=>$ders
            
            
            ]);
    }

    public function spotBilgiDersKonuSpotlari($kategori, $ders, $unite)
    {
        $konu=Spot_unite::where(DB::raw("TRIM(url)"),trim(urldecode($unite)))->first();
        if(!$konu){
            abort(404);
        }
        // dd($ders);
        $spotlar=$konu->spotlar()->orderBy('eklenme_tarihi', 'asc')->paginate(15);
        // dd($konular);

        return view('spot-bilgi-ders-konu-spotlari')->with([
            'spotlar'=>$spotlar,
            'konu'=>$konu
            ]
        );
    }
    public function spotHam(Request $request ,$kategori, $ders, $unite, $spot)
    {

        // dd(trim(urldecode($spot)));
        $spotDers = Spot_ders::where(DB::raw("TRIM(url)"),trim(urldecode($ders)))->first();
        if(!$spotDers){
            abort(404);
        }
        $dersUnite=Spot_unite::where(DB::raw("TRIM(url)"),trim(urldecode($unite)))->first();
        if(!$dersUnite){
            abort(404);
        }
        $uniteler = $spotDers->uniteler()->limit(6)->get();
       
        $uniteSpotlari=$dersUnite->spotlar()->limit(6)->get();
        $spotTek = null;
        $paginateSpotlar = $dersUnite->spotlar()->simplePaginate(1,['*'],'spot');
        if($request->input('spot')){
            // dd();
       
        foreach ($paginateSpotlar as $paginateSpot) {
           $spotTek = $paginateSpot;
        }
        // dd($spotTek);
       
        }
        else{
            // dd($spot);
            $spotTek=Spot::where(DB::raw("TRIM(url)"), trim(urldecode($spot)))->first();
            // dd($spotTek);
        }


        if(!$spotTek){
            abort(404);
        }

        // dd(isSpotBakanIp($spotTek,$request->ip()));
        // dd($spotTek->isIpBakti($request->ip()));
        if(!$spotTek->isIpBakti($request->ip())){// bu ip adresi bu spota baktı mı kontrol ediliyor
            // bakmamışsa ip adresi kaydedilip spotun hiti arttılıyor.
        
        
        $spotTek->ilkBakisIslem($request->ip()); // spota ilk bakılmada yapılacak işlemler belirlendi

        }
        
        $yorumlar=$spotTek->yorumlar()->orderBy('eklenme_tarih','desc')->get();
        // dd($paginateSpotlar);
       
        $paginateSpotlar->setPath($spotTek->url);
        
        



        //  dd($spot->unite->ders->kategori->url);
        // dd($yorumlar);
        // dd(yorumlar($yorumlar));
        // dd($yorumlar);
        // dd($spot);


        return view('spot-ham')->with('spot',$spotTek)->with('yorumlar',$yorumlar)
        ->with([
            'uniteSpotlari'=>$uniteSpotlari,
            'spotDers'=>$spotDers,
            'uniteler'=>$uniteler,
            'paginateSpotlar'=>$paginateSpotlar,

        ]);
    }

    public function forumAnasayfa()
    {

        $enSonAcilanKonular = Forum_konu::orderBy('acilis_tarihi', 'desc')->limit(10)->get();
        // foreach ($enSonAcilanKonular as $konu) {
        //     dd($konu->kategori);
        // }
        $enHitAlanKonular = Forum_konu::orderBy('goruntulenme_sayisi', 'desc')->limit(10)->get();


        $enBegeniAlanKonular = Forum_konu::orderBy('begenilme_sayisi', 'desc')->limit(10)->get();
        $selectKategoriler =null;
        if(Auth::check()){

        $selectKategoriler = Forum_konu_kategori::all();
        }
        $kategoriler = Forum_konu_kategori::orderByRaw("RAND()")->limit(5)->get();

    //    dd($kategoriler->first()->konu);
        // foreach ($kategoriler as $kategori ) {
        //     foreach($kategori->konular as $konu){
        //        if(!isset($konu->name)){
        //            dd($konu);
        //        }

        //     }
        //     // dd($kategori->konular);
        // }
        // foreach( $enSonAcilanKonular->konular as $konu){
        //     if(!isset($konu->name)){
        //         dd($konu);
        //     }

        //     foreach(  $enHitAlanKonular->konular as $konu){
        //         if(!isset($konu->name)){
        //             dd($konu);
        //         }

        
        // dd($kategoriler);





        return view('forum-anasayfa')->with([
            'enSonAcilanKonular'=>$enSonAcilanKonular,
            'enHitAlanKonular'=>$enHitAlanKonular,
            'enBegeniAlanKonular'=>$enBegeniAlanKonular,
            'kategoriler'=>$kategoriler,
            'selectKategoriler'=>$selectKategoriler


        ]);
    }
    public function forumKonuKategori($kategori)
    {
        $kategori = Forum_konu_kategori::where(DB::raw("TRIM(url)"),trim(urldecode($kategori)))->first();
        if(!$kategori){
            abort(404);
        }
        
        $kategoriKonular= $kategori->konular()->orderBy('acilis_tarihi', 'desc')->paginate(20);


        return view('forumKategoriler')->with([
            'kategori'=>$kategori,
            'kategoriKonular'=>$kategoriKonular


        ]);
    }

    public function forumKonuBireysel($kategori,$konu,Request $request)
    {
        $konu = Forum_konu::where(DB::raw("TRIM(url)"),trim(urldecode($konu)))->first();
        // $mesajSayisi = $konu->user->formKonuMesajlar->count() + $konu->user->formKonular->count();
        // dd($mesajSayisi);
        if(!$konu){
            abort(404);
        }
       
            // dd($sayi);

            if(!$konu->isIpBakti($request->ip())){// bu ip adresi bu spota baktı mı kontrol ediliyor
                // bakmamışsa ip adresi kaydedilip spotun hiti arttılıyor.
            
            
            $konu->ilkBakisIslem($request->ip()); // spota ilk bakılmada yapılacak işlemler belirlendi
                // dd($konu);
            }


        return view('forum-konu-bireysel')->with([
            'konu'=>$konu
            

            


        ]);
    }

    public function getProfile(){
        $sinavlar = Sinav::all();
        $uye = Auth::user();
        return view('uyeProfile',[
            'uye'=>$uye,
            'sinavlar'=>$sinavlar
        ]);
    }
    public function getProfilImage($uyeId){
        $uye = User::findOrFail($uyeId);
        $resim = $uye->profilResim;
        // $file = Storage::get($resim->url);
        $path = storage_path('app/'.$resim->url);
        // dd($resim->url);
        // dd($file);
        // dd($path);
        // return new Response($file, 200);
        return  Response::download($path);

    }
}
