@extends('master') 
@section('language')
<html lang="tr">
@endsection



@section('description')
<meta name="description" content="{{$ders->aciklama}}">
    
@endsection



<!--  başlık belirtilecek  -->



@section('title')
@php
    $title = 'Spot-'.$ders->name;
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
<div class="container">

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/spot">Spot</a>
            </li>
            <li class="breadcrumb-item">
            <a href="../{{$ders->kategori->url}}">{{$ders->kategori->name}}</a>
                </li>
                
            <li class="breadcrumb-item active" aria-current="page">
                {{$ders->name}}
            </li>
        </ol>
    </nav>
    <!-- //breadcrumbs -->
</div>




<!-- Services section -->
<section class=" " id="we_offer_agile">
    <div class="container py-md-5 py-3">

        <div style="width: auto;" class="services-bot-agile ">
            <div class="row mt-5">

            @php
                $index=0;
            @endphp

            @foreach ($konular  as $konu)
            <div class="col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="card-block
                       @if ($index%3==0)
                       block-1
                       @endif 
                       @if ($index%3==1) 
                       
                       @endif
                       @if ($index%3==2)
                       block-6
                       @endif
                       
                        
                        
                        ">
                            <h3 class="card-title">
                                <span>{{substr($konu->name,0,1)}}</span>{{substr($konu->name,1)}} </h3>
                                
                            <a href="{{trim($konu->ders->url)}}/{{trim($konu->url)}}" title="Spotlara Git" class="read-more">Spotlara Git
                                <i class="fa fa-angle-double-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
           
           
           
           
           
           
            @php
                $index+=1;
            @endphp
            @endforeach

            </div>
        </div>
        <div style="margin-top: 20px;">

                {{$konular->links()}}

        </div>
        
    </div>
</section>
<!-- /Services section -->
@endsection



<!-- icerik section sonu -->




@section('js')
@endsection