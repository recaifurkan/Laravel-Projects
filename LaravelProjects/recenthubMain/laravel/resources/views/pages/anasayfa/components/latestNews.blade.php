<div class="content_top_right">
    <ul class="featured_nav wow fadeInDown">
        {{-- burada en son haberlerden gösterielcek başta 4 tane sliderse gösterielcek
        geri kalan 4 tane burda gösterilecek --}}
        @foreach ($haberler as $haber)
        @php
            $haberResim = $haber->getResim('300x215');
        @endphp
        <li>
            <img width="{{$haberResim->width}}" height="{{$haberResim->height}}" 
          src="{{src($haberResim->url)}}" alt="{{$haberResim->aciklama}}">
          <div class="title_caption">
              <a href="{{getHaberUrl($haber)}}">
              {{$haber->baslik}}</a>
            </div>
        </li>
        @endforeach


      

       {{-- burada en son haberlerden gösterielcek başta 4 tane sliderse gösterielcek
        geri kalan 4 tane burda gösterilecek --}}
     
    </ul>
  </div>