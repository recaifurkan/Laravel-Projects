<div class="col-md-6">
        <div class="single_category">
            {{-- kategorinin adı burada yer alacak --}}
            <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> 
              
              <a href="{{getKategoriUrl($kategori)}}" class="title_text">{{$kategori->name}}</a> 
            </h2>{{-- kategorinin adı burada yer alacak --}}

            @php
            $enHitHaber = $kategori->getHaberler()->where('eklenmeTarihi','<',Carbon\Carbon::now())->orderBy('hit','DESC')->first();
           //  dd($enHitHaber);
            @endphp
          <ul class="fashion_catgnav wow fadeInDown">
              @if (isset($enHitHaber))
                  
              
              @php
              $haberResim = $enHitHaber->getResim('390x240');
          @endphp
             
                @include('pages.anasayfa.components.components.hitHaber')
             
             
                @endif
           
          </ul>
          <ul class="small_catg wow fadeInDown">
              @php
              $haberler = $kategori->getHaberler()->where('eklenmeTarihi','<',Carbon\Carbon::now())->orderBy('eklenmeTarihi','DESC')->limit(3)->get();
          @endphp
          @foreach ($haberler as  $haber)
            @php
                $haberResim = $haber->getResim('112x112');
            @endphp   
            <li>
                @include('pages.anasayfa.components.components.hitOlmayanHaber')
              </li> 



          @endforeach
           
          </ul>
        </div>
      </div>