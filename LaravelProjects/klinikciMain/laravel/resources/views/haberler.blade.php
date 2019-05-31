@extends('master') 
@section('language')
@endsection
 
@section('title')
<title>
@if (isset($kategori))
{{ilkHarfBuyuk($kategori->name)}} : Haberler
@else
Haberler
   
@endif
</title>
@endsection
 
@section('keywords')
@endsection
 
@section('css')
@endsection
 
@section('icerik')
<div class="container">
        @if (isset($kategori))
    <!-- breadcrumbs -->
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/haber">Haberler</a>
                </li>
              
                <li class="breadcrumb-item active " aria-current="page">
               {{ilkHarfBuyuk($kategori->name)}}
                            </li>
               
            </ol>
        </nav>
        @else
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                       Haberler
                    </li>
                  
                   
                   
                </ol>
            </nav>
        @endif

        <!-- //breadcrumbs -->
    </div>



<div class="container">
    <div class="row py-sm-5">
       
        @include('components.haberlerSlider')
        <!-- right grid -->
        <div class="col-lg-9">



            <!--    haber tekrar ettirilecek yer başlangıç          -->


            @foreach ($haberler as $haber)
            <!-- blog grid -->
            <div style="margin-bottom: 10px" class="card">
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between  border-bottom py-2">
                                <h5 class="blog-title card-title font-weight-bold">
                                    <a href="/haber/{{trim($haber->kategori->url)}}/{{trim($haber->url)}}">{{ilkHarfBuyuk($haber->baslik)}}</a>
                                </h5>
                                <div class="blog_w3icon">
                                    <span>
                                    <i class="fas fa-user mr-2"></i>{{ilkHarfBuyuk($haber->user->name)}}</span>
                                    <span class="ml-sm-3 ml-2">
                                        <span class="card-text col-sm-3"><i class="far fa-eye">{{$haber->hit}}</i></span>
                                </div> 
                            </div>
                        <p class="card-text mt-3">{{ilkHarfBuyuk($haber->kisa_aciklama)}}</p>
                            <a href="/haber/{{trim($haber->kategori->url)}}/{{trim($haber->url)}}" class="blog-btn text-dark">Habere git</a>
                            <p class="card-text">
                            <small class="text-muted">{{getAgo($haber->eklenme_tarihi)}}</small>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="/haber/{{trim($haber->kategori->url)}}/{{trim($haber->url)}}">
                           
                    <img class="card-img-haber" src="{{asset('storage/assets').'/'.$haber->kapakResim->url}}" alt="{{$haber->kapakResim->aciklama}}">
                        </a>
                    </div>
                </div>
            </div>
            <!-- //blog grid -->
            <hr>
                
            @endforeach

            

            <!--    haber tekrar ettirilecek yer başlangıç          -->

        </div>
        <!-- //right grid -->
        <div style="margin: auto;margin-top: 10px">{{$haberler->links()}}</div> 
    </div>

</div>
@endsection
 
@section('js')







@endsection