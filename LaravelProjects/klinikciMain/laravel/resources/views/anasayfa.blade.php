@extends('master') 
@section('language')
<html lang="tr">
@endsection

@section('description')
<meta name="description" content="Tıp ve diş hekimliği alanında sorularına cevap 
olacak forum kısmı ve spot bilgilerin toplandığı spot kısmı ile bilgi hazinesi">


    
@endsection







<!--  başlık belirtilecek  -->



@section('title')
@php
    $title = "Klinikçi.com";
@endphp
<title>{{$title}}</title>
@endsection




<!-- keywordlar belirtilecek -->



@section('keywords')
<meta name="keywords" content="---------------" />
@endsection
 
@section('css')
@endsection
 
@section('icerik')
<div class="container pt-3">
    <!-- slider sectionu tanımlandı -->

    @include('components.anasayfa-slider')

    <div style="margin-top: 40px;" class="row">
        <div class="col-md-12 texy-center">
            <h3 class="text-center">Spot Bilgiler</h3>
            {{-- spotlar sol tarafta duracak --}}
            @foreach ($spotDersler as $spotDers)
            @php
                $dersUnite= $spotDers->uniteler()->orderByRaw("RAND()")->first();
                if(!isset($dersUnite)){
                    continue;
                }
                $uniteSpotlari=$dersUnite->spotlar()->orderBy('created_at', 'asc')->limit(6)->get();
                if(!$uniteSpotlari->count()>0){
                    continue;
                }
               
                
            @endphp
            @if ($uniteSpotlari->count()>0)
            <div >
                    @include('components.spot-bilgiler')
            </div>  
            @endif
            @endforeach



        </div>

        <div class="col-md-12"> 
            {{-- forum konuları sağ tarafta duracak --}}

            <h3 class="text-center">Forum Konular</h3>

            <div class="card my-4 p-3 post_link">
                    <h5 class="card-header">En Son Açılan Konular</h5>
                   
                   
                   @include('components.anasayfaForumKonular',['konular'=> $enSonAcilanKonular])
                   
                </div>

                <!-- latest post -->
                <div class="card my-4 p-3 post_link">
                    <h5 class="card-header">En Beğenilen Konular</h5>
                    
                    
                    @include('components.anasayfaForumKonular',['konular'=>$enCokBegenilenKonular])
                    
                </div>




        </div>


    </div>
    




    {{-- <div class="row">
        <!-- left grid -->
      

        
               
               

                {{-- <div class="col-md-6">
                        @include('components.spot-bilgiler')
                </div> --}}

               



          

            <!--   buraya içerikleri yerleştirecen        -->

            <!-- kategoriler bunlarla gösterilecek -->


            <!-- slider sectionu tanımlandı -->


            {{-- <!-- //banner bottom -->
            <!-- about -->
            <section class="py-3">
                <!-- blog -->
                <div class="container">
                    <div style="display:inline;">
                        <span style=" width:30%;">Haberler </span>
                        <div style=" display:inline-block;width:70%;background-color:#DBDBDB; border:solid 3px;border-radius:60px;border-color:#DBDBDB;">
                        </div>
                    </div>

                    <div class="row">

                        <!-- haber tekrar edilecek burada -->
                      
                        @include('components.haberler',['haberler'=>$haberler])
                                 
                                 

                      



                    </div>
                    <div style="margin-top: 10px" class="alert alert-success text-center" role="alert">
                            <a href="/haber">Haberlere Bak</a>
                          </div>
                </div>

            </section>
            <!-- //about --> --}}







      


        <!-- //left gfrid -->
        <!-- right grid -->
        {{-- <div class="col-lg-4"> --}}
            
            
            
           

        {{-- </div> --}}
        <!-- //blog grid -->
    {{-- </div> --}}
    <!-- //right grid -->
</div>

<!-- //blog -->



<section>
    <div class="container py-sm-5">



        <section>
            <!-- latest post -->
           
               
           

        </section>

        @php
    
$tus =    $sinavlar->where('sinav_tur','Tus')->first();
$dus =    $sinavlar->where('sinav_tur','Dus')->first();

// tus zamanlayısının hesapmaları
$timestampTus = strtotime($tus->sinav_tarih);

$dayTus = date('d', $timestampTus);

$monthTus = date('m', $timestampTus);

$YearTus = date('Y', $timestampTus);


// dus zamanlayıcısını hesaplamalrı
$timestampDus = strtotime($dus->sinav_tarih);

$dayDus = date('d', $timestampDus);

$monthDus = date('m', $timestampDus);

$YearDus = date('Y', $timestampDus);

//sınav karşılaştırmala riçin işlemler yapılıyor
$tusDate = new DateTime($tus->sinav_tarih);
$dusDate = new DateTime($dus->sinav_tarih);
$nowDate = new DateTime(Carbon\Carbon::now());

// dd($tusDate);
// dd($dusDate);
// dd($nowDate);



@endphp

        <!-- daha iyisini bulana kadar en iyi timer bu   -->
        
        <div class="soon_banner layer row col-md-12">
                <script src="{{ asset('js/simplyCountdown.js') }}"></script>
                {{-- bu üstteki script anasayfadaki geri sayım için gerekli script --}}
            <div  class="soon-content-agile vertical-align col-md-6 ">
                
              
                <div class="w3l-agile text-center">
                        <h4>En yakın Tus'a kalan süre</h4>
                    </div>
                    @if ($tusDate > $nowDate)
                <!--timer-->
                <div  class="examples my-5">
                    <div class="simply-countdown-losange" id="simply-countdown-losange"></div>
                </div>
               
                <script> // timerin çalışması için yerleştirildi
                // <!-- Countdown-Timer-JavaScript -->
                   
                        $('#simply-countdown-losange').simplyCountdown({
                              year: {{$YearTus}},
                              month: {{$monthTus}},
                              day: {{$dayTus}}
                          });
                      
                      </script>
                <!--//timer-->
                @else
                <div class="w3l-agile text-center">
                        <h6  class="alert-danger">Tus tarihi henüz ösym tarafından belirtilmemiş.</h4>
                    </div>
                  

                @endif

            </div>
            <!-- //content -->

            {{-- <div class="hr"></div> --}}
            {{-- <hr style="width: 100%; color: black; height: 1px; background-color:black;" /> --}}

            <div style="padding-top: 20px" class="soon-content-agile vertical-align col-md-6">

                  
                    <div class="w3l-agile text-center">

                            <h4>En Yakın Dus'a kalan süre</h4>
                        </div>
                        @if  ($dusDate > $nowDate) 
                    <!--timer-->
                    <div class="examples my-5">
                            <div class="simply-countdown-losange" id="simply-countdown-losange2"></div>
                        </div>
                        <script> // timerin çalışması için yerleştirildi
                          $('#simply-countdown-losange2').simplyCountdown({
                                    year: {{$YearDus}},
                                    month: {{$monthDus}},
                                    day: {{$dayDus}}
                                });
                        
                                 
                        </script>
                    <!--//timer-->
                    @else
                    <div class="w3l-agile text-center">
                     
                            <h6 class="alert-danger">Dus tarihi henüz ösym tarafından belirtilmemiş.</h4>
                        </div>
    
                    @endif
                <!--timer-->
               
                <!--//timer-->

            </div>
            <!-- //content -->




        </div>

      
       



</section>
@endsection
 
@section('js')






@if (Auth::check())
                                     
                                        <script>
                                                // burada beğeni tuşu ayarlaması yapıldı
                                                            $(function(){
                                            
                                                        $('.konuBegen').click(function(e){
                                                            e.preventDefault();
                                                            var form = $(this).next();
                                                            
                                                            // console.log(form);
                                                            
                                            
                                                        $.ajax({
                                                        type: "POST",
                                                        url: form.attr('action'),
                                                        data: form.serialize() ,
                                                        success: function (data){
                                                            
                                                            // console.log(data);
                                                            location.reload();
                                                        },
                                            
                                                        });
                                            
                                            
                                                        });
                                            
                                            
                                                        });
                                            
                                            // burada beğeni tuşu ayarlaması yapıldı
                                                </script>

                                                @endif






<!-- geriye sayan sayacımızı buradan ayarlayacaz -->
<!-- easy to customize -->

@endsection