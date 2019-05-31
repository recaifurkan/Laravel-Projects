@extends('master') 
@section('language')
@endsection
 
@section('title')
@php
    $title = htmlspecialchars_decode(ilkHarfBuyuk($kategori->name)).': Forum ';
@endphp
<title> {!! $title !!}  </title>
@endsection
 
@section('keywords')
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
                     <li class="breadcrumb-item active " aria-current="page">
                     {{ilkHarfBuyuk($kategori->name)}}
                              </li>
                   
                   
                    
                      
                   
                </ol>
            </nav>
            <!-- //breadcrumbs -->
        </div>

 @include('forumKategoriyeKonuEkle')

<div class="container" style="text-align: center">
     @include('components.forumKonuArama')
   
    <section>
        
            <!-- arama sonucunda açılacak yer -->

             <!-- latest post -->
             <div class="row">
                <div class="card my-4 p-3 post_link col-md-12 ">
                <h5 class="card-header">{!! htmlspecialchars_decode(ilkHarfBuyuk($kategori->name)) !!}</h5>
 
 
                    <!--     konunun limki buraya koyulacak        -->
 
                   
                   
                    @include('components.anasayfaForumKonular',['konular'=> $kategoriKonular])
                   
                   
                   
                   
                    <!--     konunun limki buraya koyulacak        -->
 
                </div>
 
 
 
            </div>


            <div class="row ">
                    <div style="margin: auto">{{$kategoriKonular->links()}}</div>

            </div>
                   

            
      
 
            <!-- farklı konudaki konuların gösterilmesi gereken yer -->



            






        
    </section>
</div>
@endsection
 
@section('js')

@if (Auth::check())
                                     
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

{{-- <div class="row mt-3">

    <div class="forum-home-parent col-12 pl-0">
        <div class="forum-home col-md-12">
            <a href="blog.html">eveniie arcet ut moles morbi dapiti </a>
            <div>
                <span style="text-align: end" class="badge badge-secondary">26 April,2018</span>
                <span>
                    <i class="far fa-comments"></i>25</span>
                <span>
                    <i class="far fa-eye"></i>15</span>
                <span>
                    <i class="far fa-thumbs-up"></i>20</span>


            </div>
        </div>
    </div>
    <div class="hr"></div>
</div> --}}