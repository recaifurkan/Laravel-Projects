@extends('master') 
@section('language')
@endsection
 
@section('title')
@php
    $title = "Forum : Klinikçi;"
@endphp
<title>{{$title}}</title>
@endsection

@section('description')
<meta name="description" content="
Aklınıza gelecek her türlü konuda fikir alışveririşi yapabileceğiniz platform.
"> 
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
                   
                   
                    <li class="breadcrumb-item active " aria-current="page">
                   Forum
                                </li>
                   
                   
                    
                      
                   
                </ol>
            </nav>
            <!-- //breadcrumbs -->
        </div>





@include('components.forumKonuEkle',['selectKategoriler'=>$selectKategoriler])
    
    
    
    



    




<div class="container" style="text-align: center">
    @include('components.forumKonuArama')
    
   
    <section>
        
      

       <!-- arama sonucunda açılacak yer -->

       @foreach ($kategoriler as $kategori)
       @if($kategori->konular->count()>0)
       <!-- latest post -->
       <div class="row">
          <div class="card my-4 p-3 post_link col-md-12 ">
          <a href="forum/{{$kategori->url}}"><h5 class="card-header">{{$kategori->name}}</h5></a>


              <!--     konunun limki buraya koyulacak        -->

            
             
              @include('components.anasayfaForumKonular',['konular'=> $konular = $kategori->konular()->orderBy('acilis_tarihi','DESC')->paginate(15,['*'],$kategori->url)])
              <div style="margin: auto;margin-top: 10px">{{$konular->links()}}</div> 
             
             
              
            
             
             
              <!--     konunun limki buraya koyulacak        -->

          </div>

         

      </div>
      @endif

      <!-- farklı konudaki konuların gösterilmesi gereken yer -->
          
      @endforeach



       <!-- latest post -->
       <div class="row">
           <div class="card my-4 p-3 post_link col-md-12 ">
               <h5 class="card-header">En Son Tartışılan Konular</h5>


               <!--     konunun limki buraya koyulacak        -->

              
              
               @include('components.anasayfaForumKonular',['konular'=> $enSonAcilanKonular])
              
              
              
              
               <!--     konunun limki buraya koyulacak        -->

           </div>



       </div>

       <!-- farklı konudaki konuların gösterilmesi gereken yer -->

        <!-- latest post -->
        <div class="row">
           <div class="card my-4 p-3 post_link col-md-12 ">
               <h5 class="card-header">En Hit Alan Konular</h5>


               <!--     konunun limki buraya koyulacak        -->

              
              
               @include('components.anasayfaForumKonular',['konular'=> $enHitAlanKonular])
              
              
              
              
               <!--     konunun limki buraya koyulacak        -->

           </div>



       </div>

       <!-- farklı konudaki konuların gösterilmesi gereken yer -->

        <!-- farklı konudaki konuların gösterilmesi gereken yer -->

        <!-- latest post -->
        <div class="row">
           <div class="card my-4 p-3 post_link col-md-12 ">
               <h5 class="card-header">En Çok Beğeni Alan Konular</h5>


               <!--     konunun limki buraya koyulacak        -->

              
              
               @include('components.anasayfaForumKonular',['konular'=> $enBegeniAlanKonular])
              
              
              
              
               <!--     konunun limki buraya koyulacak        -->

           </div>



       </div>

       <!-- farklı konudaki konuların gösterilmesi gereken yer -->

     






       
            


       
    </section>

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


