@extends('master') 
@section('language')
<html lang="tr">
@endsection

@section('description')
<meta name="description" content="
Tus ve Dusa hazırlananların asla ayrılmaması gereken bütün
spot bilgilerin toplandığı kaynak
"> 
@endsection






<!--  başlık belirtilecek  -->


@section('title')
@php
    $title = 'Spotlar';
@endphp
<title>{{$title}}</title>
@endsection



<!-- keywordlar belirtilecek -->


@section('keywords')
<meta name="keywords" content="---------------" />
@endsection
 
@section('css')



<!-- //webfonts -->
@endsection
 
@section('icerik')

<div class="container">

        <!-- breadcrumbs -->
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   
                   
                    <li class="breadcrumb-item active " aria-current="page">
                   Spot
                                </li>
                   
                   
                    
                      
                   
                </ol>
            </nav>
            <!-- //breadcrumbs -->
        </div>

<div class="container pt-3">
    <div class="row py-sm-5">
        <!-- blog grid -->

        @foreach ($kategoriler as $kategori)
            <!--    tıp klinik spot bilgiler kategorisi burada            -->

        <div class="category col-md-4">


 
           
            <div class="card">
                <div class="">
                    <div class="card-header p-0">
                    <a href="spot/{{$kategori->url}}">
                       
                       
                            <img class="card-img-bottom spotAnasayfa" src="{{asset('storage/assets').'/'.$kategori->resim->url}}" alt="{{$kategori->resim->aciklama}}">
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="border-bottom py-2">
                            <h5 class="blog-title card-title font-weight-bold">
                                <a href="spot/{{$kategori->url}}">{{$kategori->name}}</a>
                            </h5>
                        </div>
                        <div class="blog_w3icon pt-4">
                            <span>
                                -Ders Sayısı</span>
                            <span style="margin-left: 10px;color: white;" class="badge badge-pill badge-danger">{{$kategori->dersler->count()}}</span>
                        </div>
                        @php
                         $tarih = getSpotKategoriLastTarihAndSayi($kategori)[0];
                         $sayi = getSpotKategoriLastTarihAndSayi($kategori)[1];
                        @endphp

                        <div class="blog_w3icon pt-4">
                            <span>
                                -Spot bilgi sayısı</span>
                            <span style="margin-left: 10px;color: white;" class="badge badge-pill badge-danger">{{$sayi}}</span>
                        </div>

                        

                    </div>
                
                    <div class="card-footer">
                        <p class="card-text text-right">
                            <small class="text-muted">{{getAgo($tarih)}}</small>
                        </p>
                    </div>
                </div>
            </div>


        </div>
        <!-- //blog grid -->

        <!--    tıp klinik spot bilgiler kategorisi burada            -->    
        @endforeach
        


       


    </div>
</div>
@endsection


<!-- icerik section sonu -->



@section('js')
@endsection