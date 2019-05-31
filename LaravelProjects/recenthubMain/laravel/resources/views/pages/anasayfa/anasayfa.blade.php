@extends('layouts.master')
@section('title')
<title>recentHub</title>
@endsection
@section('meta')
<meta name="description" content="RealHub Of The Latest News">
@php
$text = '';
    foreach ($kategoriler as $kategori ) {
      $text .=$kategori->name.',';
      
    }
@endphp
<meta name="keywords" content="{{$text}}">

@endsection

@section('css')

@endsection

@section('icerik')
@php
    
   
    class HaberPanel{
        private $adi;
        private $panelKatsayi;
        function __construct($adi,$panelKatsayi) {
            $this->adi = $adi;
            $this->panelKatsayi = $panelKatsayi;
        }
        public function getAdi(){
            return $this->adi;
        }
        public function getPanelKatsayi(){
            return $this->panelKatsayi;
        }
    }
    $haberPanels = [
        new HaberPanel('pages.anasayfa.components.ustteBuyukAlttaKucuk',1),
        new HaberPanel('pages.anasayfa.components.soldaBuyukSagdaSirali',2),


    ];

    function panelGetir($haberPanels,$isSon){
        
        
        global $katsayiBuffer;
        // echo $katsayiBuffer;
        // $isSon? $tanimli = 'true':$tanimli = 'false'; 
        // echo  $tanimli;
        if($katsayiBuffer%2==0 && $isSon ){
            $haberPanel = katsayiliPanelGetir(2,$haberPanels); 
            return $haberPanel;
            // dd($haberPanel);
        } 
        // echo $katsayiBuffer;
        // echo $isSon;
        // $isSon? $tanimli = 'true':$tanimli = 'false'; 
        // echo $tanimli;
        if($katsayiBuffer%2==0){
            if(!$isSon){ 
                $randSayi = rand(1,2);
                $katsayiBuffer += $randSayi;
                $haberPanel = katsayiliPanelGetir($randSayi,$haberPanels); 
            }
               
           
        }
        else{ 
            // dd($haberPanels);  
            $haberPanel = katsayiliPanelGetir(1,$haberPanels);
            $katsayiBuffer += 1;
           
        }
       
        
        return $haberPanel;
    }

    function katsayiliPanelGetir($katsayi,$haberPanels){
        shuffle($haberPanels);
            foreach ($haberPanels as $haberPanel ) {
                if($haberPanel->getPanelKatsayi()==$katsayi){
                    // dd($haberPanel);
                    return $haberPanel;
                }
                    
            }
    }
                
                
    



@endphp
<section id="mainContent">
    <div class="content_top">
      <div class="row">
          <h1 class="col-md-12 text-center">Recent News</h1>
        <div class="col-md-6">
          @php
              $enSonHaberIlk4 = [];
              $enSonHaberSon4 = [];
              $i = 0;
              foreach ($enSonHaberler as $haber) { 
                // dd($i); 
                if($i<4){
                  $enSonHaberIlk4[] = $haber;
                }
                else{
                  $enSonHaberSon4[] = $haber;
                }
                
                $i++;
              }
              // dd($enSonHaberSon4); 
              
              
              // dd($enSonHaberIlk4);
              $doluKategoriler = [];
                foreach ($kategoriler as $kategori ) {
                    if(getKategoriHaberler($kategori)->count()>0){
                        $doluKategoriler[] = $kategori;
                    }
                }
          @endphp
         @include('pages.anasayfa.components.latestSlider',['haberler'=>$enSonHaberIlk4])
        </div>
        <div class="col-md-6">
          @include('pages.anasayfa.components.latestNews',['haberler'=>$enSonHaberSon4])
        </div>
      </div>
    </div>
    
    <div class="content_middle">
        <h1 class="col-md-12 text-center">Categories News</h1>
     
     
      @for ($i = 0; $i < 4; $i++)
        <div class="col-md-3">
            <div class="content_middle_rightbar">
                @php
                $kategori2 = $doluKategoriler[$i];
            @endphp
            {{-- @if (isset($kategori2)?$kategori2->getHaberler()->where('eklenmeTarihi','<',Carbon\Carbon::now())->count()>0:false) --}}
            @include('pages.anasayfa.components.altAltaSirali',['kategori'=>$kategori2])
            {{-- @endif --}}
            </div>
        </div>
            
      @endfor
      
    </div>
    <div class="content_bottom row">
      <div class="col-md-8">
       
        <div style="float:left" class="content_bottom_left"> 
            @php
                
                
                $katsayiBuffer = 0;
                $isSon = false;
                
            @endphp
            @for ($i = 4;  $i < $count = count($doluKategoriler); $i++)  

            @php
            
                if($i == $count - 1){
                    $isSon = true;
                    // dd($isSon);
                }
                else{
                    $isSon = false; 
                    // echo $isSon;
                }
              
                $kategori = $doluKategoriler[$i];
                
                
                $haberPanel = panelGetir($haberPanels,$isSon);
            @endphp
            {{-- @if (isset($kategori)?$kategori->getHaberler()->where('eklenmeTarihi','<',Carbon\Carbon::now())->count()>0:false) --}}
        
                @include($haberPanel->getAdi(),['kategori'=>$kategori])
        
        
            {{-- @endif --}}
                
            @endfor
            
            

          
          {{-- kategoriler hazırlandı --}}
        
           
          
        </div>
      </div>
      <div class="col-md-4 ">
      {{-- buraya sağ taraftaki sidebar gelecek --}}
      @include('pages.components.sidebar',[
        'enCokHitAlanHaberler'=>$enCokHitAlanHaberler,
        'enSonBakilanHaberler'=>$enSonBakilanHaberler
      ])
        </div>

    </div>
  </section>
  
    
@endsection

@section('js')
    
@endsection