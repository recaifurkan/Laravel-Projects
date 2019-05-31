@extends('master') 
@section('language')
@endsection
 
@section('title')
@php
    $title = htmlspecialchars_decode(ilkHarfBuyuk($konu->name));
@endphp
<title>{!!$title!!}</title>
@endsection
 
@section('keywords')
<meta name="keywords" content="{!!htmlspecialchars_decode($konu->keywords)!!}" />
@endsection
  
@section('css')
@endsection
 
@section('icerik')
<div class="container">

        <!-- breadcrumbs -->
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                     <li class="breadcrumb-item" aria-current="page">
                  <a href="/forum">Forum</a>
                     </li>
                     <li class="breadcrumb-item  " aria-current="page">
                     <a href="/forum/{{trim($konu->kategori->url)}}">{{ilkHarfBuyuk($konu->kategori->name)}}</a>
                    </li>
                    <li class="breadcrumb-item active " aria-current="page">
                           {{ilkHarfBuyuk($konu->name)}}
                           </li>
                   
                   
                    
                      
                   
                </ol>
            </nav>
            <!-- //breadcrumbs -->
        </div>

@include('konuyaMesajEkle')


<div class="container pt-lg-5">
    <div class="row py-lg-5">

        <!-- konu açılış mesajı       -->
      
        <!-- blog grid -->
        <div class="card categorys">
                <div  class="badge badge-pill badge-danger">Konu Açılış Mesajı</div>
            <div class="row no-gutters">
                <div class="col-md-3" style="margin: auto">

                    <div style="text-align: center" class="col-md-12">
                       @if (isset($konu->user))
                           
                      
                        <div>
                            
                                    <img width="50%" class="text-center" src="{{route('profilResim',['uyeId'=>$konu->user->id])}}" alt="{{isset($konu->user->name) ? $konu->user->name: $konu->user->kullanici_adi }}">
                            


                       </div>
                       
                        <span class="badge badge-pill badge-secondary">{{isset($konu->user->kullanici_adi)==1 ?$konu->user->kullanici_adi:$konu->user->name }}</span>
                        
                    
                        <br>
                        <span class="badge badge-pill badge-info">Konu Sahibi
                            <i class="fas fa-check-double"></i>
                        </span>
                        @foreach ($konu->user->roller as $rol)
                            @if ($rol->name != 'Admin')
                                <div>
                                    "{{$rol->name}}"
                                    </div>
                            @endif
                        @endforeach
                       
                        @php
                                $mesajSayisi = $konu->user->formKonuMesajlar->count() + $konu->user->formKonular->count();
                            @endphp
                        <span>Toplam</span>
                        <span class="badge badge-pill badge-info"> {{$mesajSayisi}}</span>
                        <span>mesaj</span>
                        @else
                        Konu sahibi Şu anda Bulunamıyor
                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <div style="height:90%" class="card-body">
                        <div class=" text-center ">

                                <span>
                                    <i class="far fa-comments"></i>{{$konu->mesajlar->count()}}</span>
                                <span >
                                    <i class="far fa-eye"></i>{{$konu->goruntulenme_sayisi}}</span>
                                   
                                   
                                   
                                        @if (Auth::check()&& !userLikeKonu($konu)) 
                                    <a href="" class="badge-pill badge-warning text-center konuBegen"><i style="color: white" class="far fa-thumbs-up"></i> {{$konu->begenilme_sayisi}}</a>
                                   
                                   
                                    <form class="konuBegen" style="display: none;" action='/konuBegen' method="post">
                                        @csrf
                                        <input type="hidden" name="konuId" value="{{$konu->id}}">
                                    
                                    </form>
                                    @else

                                    <a  class="badge-pill badge-info  text-center"><i style="color: red" class="far fa-thumbs-up"></i> {{$konu->begenilme_sayisi}}</a>


                                    @endif

                                   
                           
                        </div>
                        
                        <div style="padding-top:2px;padding-bottom: 0px;height: 100%" class="jumbotron">
                                <h3 >{!!htmlspecialchars_decode(trim($konu->name))!!}</h3>
                                <hr style="margin:0px;">

                                <p style="margin-top:5px;" >{!! htmlspecialchars_decode($konu->aciklama) !!}</p>
                                <small style="margin-right: 0px;margin-bottom: 0px;"  class="text-muted">
                                        <span >
                                                <i class="far fa-calendar-alt"></i>{{getAgo($konu->acilis_tarihi)}}</span>
                                        </small>
                        </div>
                       

                        
                    </div>
                </div>
            </div>
        </div>
        <!-- //blog grid -->
        <!-- konu açılış mesajı       -->

    </div>


</div>
<hr>
<!--     burada da diğüer mesajlar listelenecek        -->
<div class="container pt-lg-5">
    <div class="row py-lg-5">
        @php
            $mesajlar = $konu->mesajlar()->paginate(6);


        @endphp

        @foreach ($mesajlar as $mesaj)
            
        

        <!-- konu içindeki diğer mesajlar      -->
            <!-- blog grid -->
            <div class="card categorys">
                <div class="row no-gutters">
                    <div class="col-md-3">

                        <div style="text-align: center" class="col-md-12">
                           <div>
                                <a href="single.html">
                                        <img width="50%" class="text-center" src="{{route('profilResim',['uyeId'=>$mesaj->user->id])}}" 
                                        alt="{{isset($mesaj->user->name) ? $mesaj->user->name: $mesaj->user->kullanici_adi }}">
                                </a>


                           </div>
                            
                            <span class="badge badge-pill badge-secondary">{{$mesaj->user->name}}</span>

                            @if ($konu->user->id == $mesaj->user->id)
                            <br>
                            <span class="badge badge-pill badge-info">Konu Sahibi
                                <i class="fas fa-check-double"></i>
                            </span>
                            @endif
                            @foreach ($mesaj->user->roller as $rol)
                                @if ($rol->name != 'Admin')
                                    <div>
                                        "{{$rol->name}}"
                                    </div>
                                @endif
                            @endforeach
                            
                           
                            @php
                                $mesajSayisi = $mesaj->user->formKonuMesajlar->count() + $mesaj->user->formKonular->count();
                            @endphp
                            <span>Toplam</span>
                            <span class="badge badge-pill badge-info">{{$mesajSayisi}}</span>
                            <span>mesaj</span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between border-bottom py-2">

                                <div class="blog_w3icon">
                                 <small class="text-muted"> <span class="ml-3">
                                                <i class="far fa-calendar-alt"></i>{{getAgo($mesaj->yazilma_tarihi)}} </span></small>
                                                @if (Auth::check()&& !userLikeKonu($mesaj)) 
                                                <a href="" class="badge-pill badge-warning text-center konuMesajBegen"><i style="color: white" class="far fa-thumbs-up"></i> {{$mesaj->begeni}}</a>
                                               
                                               
                                                <form class="konuMesajBegen" style="display: none;" action='/konuMesajBegen' method="post">
                                                    @csrf
                                                    <input type="hidden" name="mesajId" value="{{$mesaj->id}}">
                                                
                                                </form>
                                                @else
            
                                                <a  class="badge-pill badge-info  text-center"><i style="color: red" class="far fa-thumbs-up"></i> {{$konu->begenilme_sayisi}}</a>
            
            
                                                @endif


                                </div>
                            </div>
                            <div style="padding-top:2px;padding-bottom: 0px;height: 100%" class="jumbotron">
                                 
                                   
    
                                    <p style="margin-top:5px;" >{!! htmlspecialchars_decode($mesaj->icerik) !!}</p>
                                    <small style="margin-right: 0px;margin-bottom: 0px;"  class="text-muted">
                                            <span >
                                                    <i class="far fa-calendar-alt"></i>{{getAgo($mesaj->yazilma_tarihi)}}</span>
                                            </small>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- //blog grid -->

            @endforeach
                    
                    <!--konu içindeki diğer mesajlar      -->

        <div style="margin: auto; margin-top: 10px;">{{$mesajlar->links()}}</div>



    </div>



</div>
@endsection
 
@section('js')

@if(Auth::check())
<script>
        // burada beğeni tuşu ayarlaması yapıldı
                    $(function(){
    
                $('.konuMesajBegen').click(function(e){
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

@if (Auth::check()&& !userLikeKonu($konu))
                                     
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
@endsection