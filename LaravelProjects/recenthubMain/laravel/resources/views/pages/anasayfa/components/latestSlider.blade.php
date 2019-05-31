<div class="latest_slider">
    <div class="slick_slider">
      {{-- @php
          dd($haberler);
      @endphp --}}
      @foreach ($haberler as $haber)
      @php
            $haberResim = $haber->getResim('550x330');
        @endphp
      <div class="single_iteam">
      <img width="{{$haberResim->width}}" height="{{$haberResim->height}}" 
      src="{{src($haberResim->url)}}" alt="{{$haberResim->aciklama}}">
          <h2> 
            <a class="slider_tittle" href="{{getHaberUrl($haber)}}">{{$haber->baslik}}
            </a>
          </h2>
      </div> 
      @endforeach
        {{-- en son haberlerin slideri --}}
     
         {{-- en son haberlerin slideri --}}
    </div>
  </div>