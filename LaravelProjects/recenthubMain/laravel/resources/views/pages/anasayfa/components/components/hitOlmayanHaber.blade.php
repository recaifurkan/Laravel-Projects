<div class="media wow fadeInDown">
        <a class="media-left" href="{{getHaberUrl($haber)}}">
        <img width="{{$haberResim->width}}" height="{{$haberResim->height}}" 
        src="{{src($haberResim->url)}}" alt="{{$haberResim->aciklama}}"></a>
       <div class="media-body">
         <h4 class="media-heading">
           <a href="{{getHaberUrl($haber)}}">{{$haber->baslik}} </a></h4>
         <div class="comments_box"> 
           <span class="meta_date">{{getAgo($haber->eklenmeTarihi)}}</span> 
           <span ><i class="far fa-eye"></i><a >{{$haber->hit}}</a></span> </div>
       </div>
     </div>