@extends('layouts.master')

@section('title')
@php
    $title = $kategori->name .': recentHub';
@endphp
<title>{{$title}}</title>
@endsection
@section('meta')
<meta name="description" content="{{$kategori->aciklama}}">
<meta name="keywords" content="{{$kategori->name}}">

@endsection

@section('css')

@endsection

@section('icerik')

<section id="mainContent">
        <div class="content_bottom">
          <div class="col-md-8">
            <div class="content_bottom_left">
              <div class="single_category wow fadeInDown">
                <div class="archive_style_1">
                  <div style="margin-top:15px;">
                    <ol class="breadcrumb">
                      <li><a href="/">Home</a></li>
                      <li class="active">{{$kategori->name}}</li>
                     
                    </ol>
                  </div>
                  <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <span class="title_text">Latest Updates</span> </h2>
                 {{-- kategorinin haberleri dönecek --}}
                 @php
                     $haberler = $kategori->getHaberler()->where('eklenmeTarihi','<',Carbon\Carbon::now())->paginate(5);
                 @endphp
                 @foreach ($haberler as $haber)
                 @php
                     $haberResim = $haber->getResim('390x240');
                     $haberUrl = getHaberUrl($haber);
                     $haberBaslik = $haber->baslik;
                    
                 @endphp
                 <div class="col-md-6 wow fadeInDown">
                    <ul class="fashion_catgnav">
                      <li>
                        <div class="catgimg2_container">
                           <a href="{{getHaberUrl($haber)}}">
                           <img width="{{$haberResim->width}}" height="{{$haberResim->height}}" 
                           alt="{{$haberResim->aciklama}}" src="{{src($haberResim->url)}}"></a> </div>
                        <h2 class="catg_titile"><a href="{{$haberUrl}}">{{$haberBaslik}}</a></h2>
                        <p>{{$haber->kisaAciklama}}</p>
                        <div class="comments_box"> 
                          <span class="meta_date text-left">{{getAgo($haber->eklenmeTarihi)}} 
                          <span class="meta_more text-right"><a  href="{{getHaberUrl($haber)}}">Read More...</a></span> </div>
                       
                      </li>
                    </ul>
                  </div>
                 @endforeach
                  
                 
                   {{-- kategorinin haberleri dönecek --}}
                 
                  
                  
                  
                  
                </div>
              </div>
              <div class="pagination_area">
                  {{-- buraya pagination gelecek --}}
                  {{$haberler->links()}}
                </div>
            </div>
            
          </div>
          <div class="col-md-4">
          @include('pages.components.sidebar')
        </div>
        </div>
      </section>

    
@endsection

@section('js')
    
@endsection