@extends('master') 
@section('language')
<html lang="tr">
@endsection

@section('description')
<meta name="description" content="{!!htmlspecialchars_decode(ilkHarfBuyuk($konu->aciklama))!!}">
    
@endsection






<!--  başlık belirtilecek  -->


@section('title')
@php
    $title =htmlspecialchars_decode($konu->ders->name.'-'.$konu->name);
@endphp
<title>{!!$title!!}</title>
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
                    <a href="../../{{$konu->ders->kategori->url}}">{{$konu->ders->kategori->name}}</a>
                        </li>
                        <li class="breadcrumb-item">
                                <a href="../{{$konu->ders->url}}">{{$konu->ders->name}}</a>
                                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{$konu->name}}
                    </li>
                </ol>
            </nav>
            <!-- //breadcrumbs -->

            <div class="col-md-12">

                    <div class="card anasayfaSpot my-4 p-3 post_link">

                            <div class="spot-anasayfa">
                                    <ul>

                                            @foreach ($spotlar  as $spot)
                                           
                                                <li class="col-md-3 text-center">       
                                                    <a class="spot" title="{!! htmlspecialchars_decode(ilkHarfBuyuk($spot->icerik))!!}" >
                                                            
                                                        <p class="card-text">  {!! htmlspecialchars_decode(ilkHarfBuyuk($spot->icerik))!!}  </p>
                                                    </a>
                                                           
                                                                <a class="spotaGit" href="{{$spot->unite->url}}/{{trim($spot->url)}}">Spota Git  {{$spot->resimler->count()>0 ? 'Resimli':'' }}
                                                                 </a>
                                                           
                                                           
                                                      
                                                   
                                        
                                                   
                                                </li>
                                                <hr>
                                                   
                                        
                                        @endforeach
                                              

                                        


                                    </ul>

                            </div>
                    </div>

                </div>
        </div>

    

      

   





<!-- spotlar bu şekilde ayarlanacak yalnız döngüde dikkat et 3 kere de başa alsın -->
<!-- Services section -->
{{-- <section class=" " id="we_offer_agile">
    <div class="container py-md-5 py-3">

        <div style="width: auto;" class="services-bot-agile ">
            <div class="row spot-card">
                    @php
                    $index=0;
                @endphp
    
                @foreach ($spotlar  as $spot)
                <div class="col-md-12  ">
                        <div class="card ">
                            <div class="card-block spot-card text-center">
                                   
                        <a href="{{$spot->unite->url}}/{{trim($spot->url)}}" title="Spota Git" >
                                
                            <p class="card-text">  {!! htmlspecialchars_decode(ilkHarfBuyuk($spot->icerik))!!}  </p>
                        </a>

                        <a href="{{$spot->unite->url}}/{{$spot->url}}" title="Spota Git" class="read-more">
                               Spota Git {{$spot->resimler->count()>0 ? '(Resimli)':'' }}
                               
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
       
    </div>
</section>
<!-- /Services section --> --}}



<div style="margin-top: 10px" class="row justify-content-center">
           
        <div class="col-xs-5">
                {{$spotlar->links()}}
        </div>
        
    </div>
@endsection


<!-- icerik section sonu -->



@section('js')

<script>
    $(function(){

        // spot yazısına hover olunca yapılcaklar işlendi
        var show = true;
        var href = null;
         $('.spot').hover(function(e){
     var spotaGit = $(this).next();
    
       e.preventDefault();
       show = !show;
     
       if(show){
        //    link hover giderse geri ekleniyor 
        spotaGit.css( "opacity", 1 );
        spotaGit.attr('href',href);
        // console.log(href);
              
       }
       else{
        //    eğer hover olursa link gizleniyor 
        spotaGit.css( "opacity", 0 );
        href = spotaGit.attr('href');
        spotaGit.removeAttr('href');
        // console.log(href);
       }
  }); 
   // spot yazısına hover olunca yapılcaklar işlendi

    




            });
                                            
                                                
</script>

@endsection