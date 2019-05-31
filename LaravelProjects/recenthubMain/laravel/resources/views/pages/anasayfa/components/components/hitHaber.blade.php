<li>

    {{-- <div class="hitHaber">
            @php
            $haberResim = $enHitHaber->getResim('390x240');
        @endphp
         <a href="{{getHaberUrl($enHitHaber)}}">
                <img width="{{$haberResim->width}}" height="{{$haberResim->height}}" 
                alt="{{$haberResim->aciklama}}" src="{{src($haberResim->url)}}"></a>
        <h2>
                <a href="{{getHaberUrl($enHitHaber)}}">{{$enHitHaber->baslik}}</a>
        </h2>
        <div>
                <span class="meta_date">{{$enHitHaber->eklenmeTarihi}}</span> 
                <span class="meta_more">
                  <a  href="{{getHaberUrl($enHitHaber)}}">Read More...</a></span>
        </div>
        <p>{{$enHitHaber->kisaAciklama}}</p>
    </div>  --}}

        <div class="catgimg2_container"> 
         
          <a href="{{getHaberUrl($enHitHaber)}}">
          <img width="{{$haberResim->width}}" height="{{$haberResim->height}}" 
          alt="{{$haberResim->aciklama}}" src="{{src($haberResim->url)}}"></a>
         </div>
         <a href="{{getHaberUrl($enHitHaber)}}"> 
            <h2 class="catg_titile">
            {{$enHitHaber->baslik}}
            </h2>
        </a>
      
        <div class="comments_box">
           <span class="meta_date">{{getAgo($enHitHaber->eklenmeTarihi)}}</span> 
            <span class="meta_more">
              <a  href="{{getHaberUrl($enHitHaber)}}">Read More...</a></span> </div>
        <p>{{$enHitHaber->kisaAciklama}}</p>
      </li>