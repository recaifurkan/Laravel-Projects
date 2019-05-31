<!-- latest post -->
<div class="card anasayfaSpot my-4 p-3 post_link">
       
        <h4 class="text-center"><a  href="{{route('spot-uniteler',[
            'kategori'=>$spotDers->kategori->url,
            'ders'=>$spotDers->url
            ])}}">
         <span class="spot_ders ">{{$spotDers->name}}</span>   
         </a> </h4>
    
    
    
     <div class="spot-anasayfa  mt-3" style="text-align: center">
        <ul>
         @foreach ($uniteSpotlari as $spot)
         @include('components.spot-ham.sidebar-spotlar-component') 
         {{-- <div class="spot-pano col-12">
                 <div>
                     <a style="line-height: 40px;" href="/spot/{{$spotDers->kategori->url}}/{{$spotDers->url}}/{{$spot->unite->url}}/{{$spot->url}}">
                         <div class="anasayfaText text-center">{!! str_replace(['<br>↓<br>','<br>'],['→',','],htmlspecialchars_decode($spot->icerik))!!}</div>
                                                                                         </a>
                             <div class="text-white text-center spot-bilgi">



                                     <div   >
                                            
                                      <span class="badge badge-pill badge-info"> <i style="color:black;" class="far fa-eye"></i>{{$spot->hit}}</span>
                                    
                                     <span class="badge badge-pill badge-danger">  <i style="" class="far fa-thumbs-up"></i>{{$spot->like}}</span>
                                     
                                     @if (Auth::check()&& !userLikeSpot($spot))
                                     <a href="" class="spotBegen" style="height: 25px;line-height: 19px;"   class="badge"> <i class="far fa-thumbs-up"></i>Beğen</a>
                                             <form class="spotBegen" style="display: none;" action='/spotBegen' method="post">
                                                 @csrf
                                                 <input type="hidden" name="spotId" value="{{$spot->id}}">
                                             
                                             </form>
     
                                             @endif
                                             
     
     
                                 </div>
                                 <div >
                                     
                                 </div>
                     
                             
                     
                         </div>                                                   
             
                 </div>
                 <div class="hr"></div>
                 
                 <p class="card-text">
                     <small class="text-muted"></small>
                 </p>
             
             </div> --}}


    
    
     
        
         @endforeach
     </ul>
         

            

         
     </div>



 </div>


 <script>
 // burada beğeni tuşu ayarlaması yapıldı
             $(function(){

         $('.spotBegen').click(function(e){
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
