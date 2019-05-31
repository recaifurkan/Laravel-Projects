@extends('layouts.master')

@section('title')
@php
    $title = $haber->baslik
@endphp
<title>{{$title}}</title>
@endsection
@section('meta')
<meta name="description" content="{{$haber->kisaAciklama}}">
<meta name="keywords" content="{{$haber->anahtarKelimeler}}">
<meta name="author" content="{{$haber->getYazar->adiSoyadi}}">
@endsection

@section('css')

@endsection

@section('icerik')
<section id="mainContent">
        <div class="content_bottom">
          <div class="col-md-8">
            <div class="content_bottom_left">
              <div class="single_page_area">
                <ol class="breadcrumb">
                  <li><a href="#">Home</a></li>
                  <li><a href="{{getKategoriUrl($haber->getKategori)}}">{{$haber->getKategori->name}}</a></li>
                  <li class="active">{{ilkHarfBuyuk($haber->baslik)}} </li>
                </ol>

                {{-- buraya habverin kısa açıklaması gelecek --}}
                <h2 class="post_titile">{{ilkHarfBuyuk($haber->baslik)}} </h2>
                {{-- buraya habverin kısa açıklaması gelecek --}}

                
                <div class="single_page_content">
                  <div class="post_commentbox"> 
                      <a href="#"><i class="fa fa-user"></i>{{$haber->getYazar->adiSoyadi}}</a> 
                      <span><i class="fa fa-calendar"></i>{{getAgo($haber->eklenmeTarihi)}}</span>
                       <a href="#"><i class="fa fa-tags"></i>{{$haber->getKategori->name}}</a> 
                </div>

                {{-- haberin Resmi burada yer alacak --}}
                @php
                    $haberResim= $haber->getResim('550x330');
                @endphp
                  <img width="{{$haberResim->width}}" height="{{$haberResim->height}}" 
                  class="img-center" 
              src="{{src($haberResim->url)}}" alt="{{$haberResim->aciklama}}">
                   {{-- haberin Resmi burada yer alacak --}}
                   <blockquote> {{$haber->kisaAciklama}} </blockquote>
                   {{-- haber içerik  burada yer alacak --}}
                  {!!$haber->icerik!!}
                   {{-- haber içerik  burada yer alacak --}}

                   {{-- alttakiler ne olur ne olmaz yorum olarak kalsın  --}}
                  {{-- <ul>
                    <li>Nunc sed aliquet nisi. Nullam ut magna</li>
                    <li>Nunc sed aliquet nisi. Nullam ut magna non lacus adipiscing volutpat</li>
                    <li>Nunc sed aliquet nisi. Nullam ut magna</li>
                    <li>Nunc sed aliquet nisi. Nullam ut magna non lacus adipiscing volutpat</li>
                    <li>Nunc sed aliquet nisi. Nullam ut magna</li>
                    <li>Nunc sed aliquet nisi. Nullam ut magna non</li>
                  </ul>
                  <button class="btn">Default</button>
                  <button class="btn btn-primary">Primary</button>
                  <button class="btn btn-success">Success</button>
                  <button class="btn btn-info">Info</button>
                  <button class="btn btn-warning">Warning</button>
                  <button class="btn btn-danger">Danger</button> --}}
                     {{-- üsttekiler ne olur ne olmaz yorum olarak kalsın  --}}
                </div>
              </div>
            </div>

            {{-- paginationa el atılacak artık bir şekilde --}}
            <div class="text-center post_pagination">
              {{$paginateHaber->links()}}
            </div>

             {{-- paginationa el atılacak artık bir şekilde --}}

            {{-- paylaşma butonları ayarlanacak --}}
            <div class="text-center" >
           
                    @include('pages.components.paylas.shareButtons')
              
            </div>
           
            
            {{-- paylaşma butonları ayarlanacak --}}


            <div class="similar_post">
              <h2>Similar Post You May Like <i class="fa fa-thumbs-o-up"></i></h2>
              <ul class="small_catg similar_nav wow fadeInDown animated">

                @foreach ($benzerHaberler as $benzerHaber)
                     {{-- aynı kategorinin haberleridne 3 tane  döşenecek --}}
                     @php
                     $haberResim= $benzerHaber->getResim('112x112');
                     @endphp
                  <li>
                      <div class="media wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
                         <a class="media-left related-img" href="{{getHaberUrl($benzerHaber)}}">
                          {!!getHaberResim($haberResim)!!}
                         </a>
                        <div class="media-body">
                          <h4 class="media-heading">
                          <a href="{{getHaberUrl($benzerHaber)}}">{{$benzerHaber->baslik}} </a></h4>
                          <p>{{$benzerHaber->kisaAciklama}} </p>
                        </div>
                      </div>
                    </li>
                    {{-- aynı kategorinin haberleridne  3 tane döşenecek --}}
                @endforeach
                 
               
              
              </ul>
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