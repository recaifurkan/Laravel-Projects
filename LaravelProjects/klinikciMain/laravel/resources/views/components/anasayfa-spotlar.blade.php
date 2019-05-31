
  


    <li class="col-md-4">
      <a href="/spot/{{$spotDers->kategori->url}}/{{$spotDers->url}}/{{$spot->unite->url}}/{{$spot->url}}">
      
        <p>{!! str_replace(['<br>↓<br>','<br>'],['→',','],htmlspecialchars_decode($spot->icerik))!!}
       
                       


          
        </p>
     
      
            <span class="badge badge-pill badge-info"> <i style="color:black;" class="far fa-eye"></i>{{$spot->hit}}</span>
            <span class="badge badge-pill badge-danger">  <i style="" class="far fa-thumbs-up"></i>{{$spot->like}}</span>
                   @if (Auth::check()&& !userLikeSpot($spot))
                   <a href="" class="spotBegen" style="height: 25px;line-height: 19px;"   class="badge"> <i class="far fa-thumbs-up"></i>Beğen</a>
                           <form class="spotBegen" style="display: none;" action='/spotBegen' method="post">
                               @csrf
                               <input type="hidden" name="spotId" value="{{$spot->id}}">
                           
                           </form>
    
                           @endif 

                        </a>
    </li>

   
   
   
   


 

