<div class="single_category wow fadeInDown">

        {{-- kategori ismi burada yazacak --}}
        <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span>
             <a href="{{getKategoriUrl($kategori)}}" class="title_text">{{$kategori->name}}</a> 
            </h2>
        {{-- kategori ismi burada yazacak --}}
        <ul class="catg1_nav">
            @php
                $kategoriHaberleri = $kategori->getHaberler()->where('eklenmeTarihi','<',Carbon\Carbon::now())->limit(2)->get();
            @endphp
            @foreach ($kategoriHaberleri as $haber)
            @php
                $haberResim = $haber->getResim('300x215');
            @endphp
            <li>
                <div class="catgimg_container"> 
                <a href="{{getHaberUrl($haber)}}" class="catg1_img">
                <img width="{{$haberResim->width}}" height="{{$haberResim->height}}" 
                alt="{{$haberResim->aciklama}}" src="{{src($haberResim->url)}}"></a></div>
                <h3 class="post_titile">
                    <a href="{{getHaberUrl($haber)}}">{{$haber->baslik}}</a></h3>
            </li>
            @endforeach
            {{-- kategoriden rastgele 2 tane haber seçilecek --}}
            
                {{-- kategoriden rastgele 2 tane haber seçilecek --}}
                
                
    </ul>
    </div>