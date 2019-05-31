@extends('master') 
@section('language')
<html lang="tr">
@endsection






<!--  başlık belirtilecek  -->


@section('title')
@php
    $title = $kategori->name;
@endphp
<title>{{$title}}</title>
@endsection



<!-- keywordlar belirtilecek -->


@section('keywords')
<meta name="keywords" content="{{$kategori->keywords}}" />
@endsection
 
@section('css')
@endsection
 
@section('icerik')

<div class="container">

    <!-- breadcrumbs -->
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/spot">Spot</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                        {{$kategori->name}}
                </li>
            </ol>
        </nav>
        <!-- //breadcrumbs -->
</div>



       @if (!$dersler->first())
       
       @include('components.eklenmedi',['olmayan'=>'spot'])


       @else
       

    <div class="container">
        
      

       @foreach ($dersler as $ders)
        
    <div class="row py-lg-5">
       <div class="card category">
           <div class="row no-gutters">

               <div class="col-md-8">
                   <div class="card-body">
                       <div class="d-sm-flex justify-content-between border-bottom py-2">



                           <h5 class="blog-title card-title font-weight-bold">
                           <a href="{{$ders->kategori->url}}/{{$ders->url}}">{{$ders->name}}</a>
                           </h5>
                           <div class="col-md-2">
                               <a href="{{$ders->kategori->url}}/{{$ders->url}}">
                                   
                                   <img width="80px;" src="{{asset('storage/assets').'/'.$ders->resim->url}}" alt="{{$ders->resim->aciklama}}">
                               </a>
                           </div>

                       </div>
                   <p class="card-text mt-3">{{$ders->aciklama}}</p>
                       <a href="{{$ders->kategori->url}}/{{$ders->url}}" class="blog-btn text-dark">Ders Git</a>
                       
                   </div>
               </div>
               <div style="line-height: 75px;" class="col-md-4">

                   <ul class="list-group  ">
                       <li class="list-group-item d-flex justify-content-between align-items-center">
                           Toplam Ünite Sayısı
                       <span class="badge badge-primary badge-pill">{{getDersUnitelerAdet($ders)}}</span>
                       </li>
                       <li class="list-group-item d-flex justify-content-between align-items-center">
                           Spot bilgi sayısı
                           <span class="badge badge-primary badge-pill">{{getDersSpotlarAdet($ders)}}</span>
                       </li>
                       <li class="list-group-item d-flex justify-content-between align-items-center">
                           Toplam Görüntülenme
                           <span class="badge badge-primary badge-pill">{{getSpotDersGoruntulenme($ders)}}</span>
                       </li>
                   </ul>



               </div>

           </div>
       </div>
    </div>

           
       


      
      
       <!-- //blog grid -->
       <!--   dersler için tekrarlanacak yer burası aman dikkat ders içerik uzun olsun       -->
       @endforeach

       {{ $dersler->links() }}
           
       @endif

       
        
       
        <!--   dersler için tekrarlanacak yer burası aman dikkat ders içerik uzun olsun       -->
        
        <!-- blog grid -->
        
        

    
</div>
@endsection


<!-- icerik section sonu -->



@section('js')
@endsection