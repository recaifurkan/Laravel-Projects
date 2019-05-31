@extends('master') 
@section('language')
<html lang="tr">
@endsection






<!--  başlık belirtilecek  -->


@section('title')
<title>{{ilkHarfBuyuk($haber->baslik)}} : Haberler</title>
@endsection



<!-- keywordlar belirtilecek -->


@section('keywords')
<meta name="keywords" content="{{$haber->keywords}}" />
@endsection
 
@section('css')
@endsection
 
@section('icerik')





<div class="container">

        <!-- breadcrumbs -->
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/haber">Haberler</a>
                    </li>
                    <li class="breadcrumb-item">
                    <a href="/haber/{{trim($haber->kategori->url)}}">{{ilkHarfBuyuk($haber->kategori->name)}}</a>
                        </li>
                   
                    <li class="breadcrumb-item active " aria-current="page">
                   {{ilkHarfBuyuk($haber->baslik)}}
                                </li>
                   
                   
                    
                      
                   
                </ol>
            </nav>
            <!-- //breadcrumbs -->
        </div>
<!--  single page -->
<section class="single_blog_wthree py-3">
    <div class="container pt-lg-5">
        <div class="row py-sm-3">
            <!-- single page left grid -->
            <div class="col-lg-9  single-left">
                <div class="row show-top-grids">
                    <div style="width: 90%" class="card">
                        <h5 class="blog-title singlpage_w3 card-title font-weight-bold">
                        {{ilkHarfBuyuk($haber->baslik)}}
                        </h5>
                       
                      
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between border-bottom pb-3">
                                    <div class="blog_w3icon">
                                            <span>
                                            <i class="fas fa-user mr-2"></i>{{ilkHarfBuyuk($haber->user->name)}}</span>
                                            <span class="ml-sm-3 ml-2">
                                                <span class="card-text col-sm-3"><i class="far fa-eye">{{$haber->hit}}</i></span>
                                        </div> 
                            </div>
                            <article class="mt-3">{!!htmlspecialchars_decode($haber->icerik)!!}</article>
                           
                        </div>
                       
                        <div class="card-footer">
                            <p class="card-text">
                                <small class="text-muted">{{getAgo($haber->eklenme_tarihi)}}</small>
                            </p>
                        </div>
                      
                    </div>
                   
                    <div style="width: 100%;margin-top: 20px;">
                            @include('haberler-yorum.yorumlar')

                    </div>
                        
                      
                        
                    
                </div>
            </div>
            <!-- //single page right grid -->
            @include('components.haberlerSlider')
        </div>
    </div>
</section>
<!-- //single blog -->
@endsection
 
@section('js')
@endsection