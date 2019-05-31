<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Haber;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getHome()
    {

        $enSonHaberler = Haber::where('eklenmeTarihi','<',Carbon::now())->orderBy('eklenmeTarihi', 'DESC')->limit(8)->get();
        $enCokHitAlanHaberler = Haber::where('eklenmeTarihi','<',Carbon::now())->orderBy('hit', 'DESC')->limit(4)->get();
        $enSonBakilanHaberler = Haber::where('eklenmeTarihi','<',Carbon::now())->orderBy('updated_at', 'DESC')->limit(4)->get();
        $kategoriler = Kategori::all();
        // $enSonHaberIlk4 = $enSonHaberler;
        // $enSonHaberSon4 = $enSonHaberler->skip(4)->limit(4)->get();
        // dd($enSonHaberIlk4);

        //    dd($haberSayi);
        $haberSayi = Haber::where('eklenmeTarihi','<',Carbon::now())->count();
        if ($haberSayi >= 9) {
            $randomHaberler = Haber::where('eklenmeTarihi','<',Carbon::now())->get()->random(9);
        } else {
            $randomHaberler = Haber::where('eklenmeTarihi','<',Carbon::now())->get()->random($haberSayi);
        }

        //    dd($randomHaber);

        //    dd($kategoriler->first()->getHaberler);
        // dd( $enSonHaberler->get(2));
        return view('pages.anasayfa.anasayfa', [
            'enSonHaberler' => $enSonHaberler,
            'enCokHitAlanHaberler' => $enCokHitAlanHaberler,
            'enSonBakilanHaberler' => $enSonBakilanHaberler,
            'kategoriler' => $kategoriler,
            'randomHaberler' => $randomHaberler,

        ]);
    }

    public function getCategorie($kategori)
    {
        $kategori = Kategori::where('url', trim(urldecode($kategori)))->firstOrFail();
        $enCokHitAlanHaberler = $kategori->getHaberler()->where('eklenmeTarihi','<',Carbon::now())->orderBy('hit', 'DESC')->limit(4)->get();
        $enSonBakilanHaberler = $kategori->getHaberler()->where('eklenmeTarihi','<',Carbon::now())->orderBy('updated_at', 'DESC')->limit(4)->get();

        // dd($kategori);
        return view('pages.kategoriHaberleri', [
            'kategori' => $kategori,
            'enCokHitAlanHaberler' => $enCokHitAlanHaberler,
            'enSonBakilanHaberler' => $enSonBakilanHaberler,

        ]);
    }

    public function getNew($kategori, $haberUrl, Request $request)
    {
        // dd($haber);
        $haber = null;
        $paginateHaberler = Haber::where('eklenmeTarihi','<',Carbon::now())->simplePaginate(1);
        if ($request->input('page')) {
            foreach ($paginateHaberler as $paginateHaber) {
                $haber = $paginateHaber;
            }
        } else {
            $haber = Haber::where('url', trim(urldecode($haberUrl)))->firstOrFail();

        }
        // dd($haber);
        $haber->hitIslem($request->ip);
        $haber->updated_at = Carbon::now();
        $haber->update();
        

        $kategori = $haber->getKategori;
        $enCokHitAlanHaberler = $kategori->getHaberler()->where('eklenmeTarihi','<',Carbon::now())->orderBy('hit', 'DESC')->limit(4)->get();
        $enSonBakilanHaberler = $kategori->getHaberler()->where('eklenmeTarihi','<',Carbon::now())->orderBy('updated_at', 'DESC')->limit(4)->get();
        $benzerHaberler = $kategori->getHaberler()->where('eklenmeTarihi','<',Carbon::now())->limit(3)->get();

        return view('pages.haberPage', [

            'haber' => $haber,
            'enCokHitAlanHaberler' => $enCokHitAlanHaberler,
            'enSonBakilanHaberler' => $enSonBakilanHaberler,
            'benzerHaberler' => $benzerHaberler,
            'paginateHaber'=>$paginateHaberler

        ]);  
    } 
 
    public function getContact(){
        return view('pages.iletisim');
    }

    public function search(Request $request){
        $haberler = Haber::Where('icerik', 'like', '%' . $request->search . '%')->
        orWhere('anahtarKelimeler', 'like', '%' . $request->search . '%')->
        orWhere('baslik', 'like', '%' . $request->search . '%')->paginate(10);
        // dd($haberler);
        // dd($request->all());
        return view('pages.searchPage',[
            'searchText'=>$request->search,
            'haberler'=>$haberler
        ]);

        

    }
}
