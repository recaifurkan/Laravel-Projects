@extends('master') 
@section('language')
<html lang="tr">
@endsection


@section('description')
<meta name="description" content="{!!str_replace("<br>","",htmlspecialchars_decode(ilkHarfBuyuk($spot->icerik)))!!}">
    
@endsection



<!--  başlık belirtilecek  -->


@section('title')
@php
    $title = htmlspecialchars_decode(ilkHarfBuyuk($spot->icerik));
@endphp
<title>{!!$title!!}</title>
@endsection



<!-- keywordlar belirtilecek -->


@section('keywords')
<meta name="keywords" content="{{$spot->keywords}}" />
@endsection
 
@section('css')

<link rel="stylesheet" href="{{asset('css/smartphoto.min.css')}}">
<link rel="stylesheet" href="{{asset('css/styles.css')}}">
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
                            <a href="../../../{{$spot->unite->ders->kategori->url}}">{{$spot->unite->ders->kategori->name}}</a>
                                </li>
                    <li class="breadcrumb-item">
                    <a href="../../{{$spot->unite->ders->url}}">{{$spot->unite->ders->name}}</a>
                        </li>
                        <li class="breadcrumb-item">
                                <a href="../{{$spot->unite->url}}">{{$spot->unite->name}}</a>
                                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ilkHarfBuyuk(showKarakter($spot->icerik,15))}}
                    </li>
                </ol>
            </nav>
            <!-- //breadcrumbs -->
        </div>

<div class="container">
    <div class="row">
        <!-- left grid -->
        <div class="col-lg-8">
            <div class="row">
                @if ($spot->resimler->count()>0)
                <div class="masonry col-md-3 ">
                        <div class="brick">
            
                            @foreach ($spot->resimler as $resim)
                              @if ($loop->index==0)
                              
                              <a href="{{asset('storage/assets').'/'.$resim->url}}" class="js-img-viwer" data-caption="{{$spot->icerik}}" data-id="raion">
                                <img class="spotImage" src="{{asset('storage/assets').'/'.$resim->url}}" />
                                </a>
                            @else
                            <a style="display: none" href="{{asset('storage/assets').'/'.$resim->url}}" class="js-img-viwer" data-caption="{{$spot->icerik}}" data-id="raion">
                                <img style="width: 100%" src="{{asset('storage/assets').'/'.$resim->url}}" />
                                </a>
        
                             @endif 
                            
                           
                            @endforeach
                           
                           
                                    
                        </div>
        
        
                    </div>
                    <div class="col-md-9">
                           
                        @include('components.spot-ham.spot-ham-spot-yazi')
        
                    </div>
                @else
                <div class="col-md-12">
                       
                        @include('components.spot-ham.spot-ham-spot-yazi')
    
                </div>
                    
                @endif
                
               
        </div>

       

        <div style="margin-top: 10px" class="row justify-content-center">
           
            <div class="col-xs-5">
                    {{$paginateSpotlar->links()}}
            </div>
        </div>
        


        @include('components.spot-ham.spot-ham-yorum-kisim')
      
    

   
    </div>
      
                

                






 

  
        <!-- //left grid -->
        <!-- right grid -->
        <div class="col-lg-4 sidebar_wthree">
            <!-- Search Widget -->
            <div class="card mb-4">
                <div class="card-body">

                    <form id="searchForm" class="input-group" method="post" action="/spotSearch">
                        @csrf
                        <input id="search-text" name="searchText" type="text" class="form-control" placeholder="Spot Ara">
                        <span class="input-group-btn">
                            <button value="searchSpot" name="searchSpot" class="btn btn-secondary" type="submit">Ara!</button>
                        </span>


                    </form>






                </div>
                </div>

                <!-- arama sonucunda açılacak -->
            <!-- latest post -->
            <div style="display: none;" id="search-result" class="row">
                    
                    <div  class="card my-4 p-3 post_link col-md-12">
                            <h5 class=" card-header"><span id="aranan-kelime" class="badge badge-info"></span><span> için sonuçlar</span> </h5>
                        <div id="result">


                        </div>
    
    
                        <!--     konunun limki buraya koyulacak        -->
    
                      
                        <!--     konunun limki buraya koyulacak        -->
    
                    </div>
    
    
    
                </div>
    
                <!-- arama sonucunda açılacak yer -->
            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Konular</h5>
                <div class="card-body">
                    <ul class="w3-tag2">
                        
                        @foreach ($uniteler as $unite)
                        <li>


                                <!-- konuları buradan tekrar ettirirsin -->
                                <a href="../{{$unite->url}}">
                                    <i class="fa fa-angle-right mr-2"></i>{{$unite->name}}</a>
    
    
                            </li>
                        @endforeach
                        

                    </ul>
                </div>
            </div>

            <!-- latest post -->
           @include('components.spot-ham.sidebar-spotlar')
        </div>
        <!-- //right grid -->
    </div>
</div>
<!-- //blog -->
</div>
@endsection


<!-- icerik section sonu -->



@section('js')



<script src="{{asset('js/smartphoto.js?v=1')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded',function(){
		new SmartPhoto(".js-img-viwer",{
            resizeStyle:'fit'
        });
	});
</script>

{{-- <script>

   var bastaBeklemeSuresi = 2000;
   var harfKaymaSuresi = 200;
   var birTurBeklemeSuresi = 1000;

   
// function (){
                       
             
            
//              ilkHarf = icerik.mb_substr(0,1);
//             //  console.log(ilkHarf);
//              geriKalan = icerik.mb_substr(1,icerik.lenght);
//              icerik = geriKalan + ilkHarf;
//             //  console.log(kaymisYazi);
//             $('#spot_icerik').html(icerik);

// }



     
        
    
//         // $("#spot_icerik").animate({width:'0'},1);
//         $(function(){
//             // console.log();
//             var icerik=$("#spot_icerik").html().trim();
           
//             var icerikCopy = icerik;
//             icerikLenght = icerik.length-1;
//             var acik = true;
//               var i = 0;
//               var interval;
            
//             function kayanYazi (){
               
                
                
              
//                 interval = window.setInterval(function(){
//                 if(acik){
//                 if(i==icerikLenght){
//                 clearInterval(interval);
//                 i = 0;
//                 icerik = icerikCopy;
//                 $("#spot_icerik").html(icerik);
//                 setTimeout(kayanYazi,birTurBeklemeSuresi);
                
//                 }
//                 $("#spot_icerik").html(icerik);
//                 icerik = icerik.substr(1,icerik.lenght);
               
//                 // console.log(icerik);
//                 console.log(i);
//                 i++;

//                 }},harfKaymaSuresi);
// };

//                 setTimeout(kayanYazi,bastaBeklemeSuresi);
                                

//                 $('#spot_icerik').click(function(){


//                     acik=!acik;
//                 });




                // $("#spot_icerik").on('hover touchstart', function() {

                //      acik=false;
                // });

                

                //     $("#spot_icerik").on('mouseout touchend', function(event) {
                //         acik=true;
                //     });
                    
 

               


            // burada en son kayan yazı için zamanlama yapıyodun onu ayarlarsın kayan yazı için 
            // kayan yazıyı düzelt düzelt düzgün olsun onun dışında diğerlerini düzgün yaptın yzaten
            
           
            
            
            // for(var i = 0; i<=icerikLenght;i++){
               
            //     var timeOut = setTimeout(function(){
            //         icerik = icerik.substr(1,icerik.lenght);
            //         $("#spot_icerik").html(icerik);

            //     },200);

            // }
            // $('#spot_icerik').animate({"margin-right": '+=200'});
            

            //   $('#spot_icerik').show("slide", { direction: "left" }, 1000);

        //     icerik = $('#spot_icerik').html().trim();
        //     icerik+='      ';
        //     var dongu = setInterval(,250);
            
           
        //        $('.cevaplaButton').on( "click", function(e) { 
        //        e.preventDefault();
        //        $($(this)).next().slideToggle();
        //     //    console.log( 'text' ); 
               
               
        //        }); 
               
               
               
               });
             
              
                                      
    </script> --}}

        <script>



    var searchTime = 700;

    //aramayla ilgili fonksiyonlar işlemler burada yapılıyor
        $(function(){

            var form = $('#searchForm').submit(function(e){
                    
                e.preventDefault();


                });
               
              
        $('#search-text').on('input',function(e){
          var girilenYazi = $(this).val();
           
            if(girilenYazi==''){
                $('#search-result').slideUp(searchTime);
            }
            else{
                $('#search-result').slideDown(searchTime);
                        $('#aranan-kelime').html(girilenYazi);
                
                // burada jquery post atacan gelenle işlem yapacan
                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(data){
                        var result = $('#result');
                       
                           
                           
                        
                       
                        var text = '';
                        
                        data = JSON.parse(data);
                        // console.log(typeof data !== 'undefined' && data.length > 0);
                        if(typeof data !== 'undefined' && data.length > 0){
                            // console.log('boş');
                            Object.keys(data).forEach(function(spot , index) {

                                text += '<div class="row mt-3">'+
                                            '<div class="forum-home-parent col-12 pl-0">'+
                                                    '<div class="forum-home col-md-12">'+
                                                        '<a href="'+data[spot]["url"] +'">'+ data[spot]["icerik"]  +'</a>'+
                                                        '</div> </div> <div class="hr"></div></div>';

    
                                 console.log(data[spot]['icerik']);
                          });
                          
                        }
                        else{
                            text='<span class="text-justify badge badge-danger">'+girilenYazi + ' için sonuç bulunamadı...'+'</span>';
                        }
                        

                        
                       
                        
                          result.html(text);
                        
                        },



                        
                        
                    error: function (xhr, ajaxOptions, thrownError) { 
                       
                        }
                    
                   
                    });

              
            }
           
    
    });
    
    
    
    });
    </script>

  
@endsection