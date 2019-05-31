<div class="col-md-12">


<div class="single_category wow fadeInDown">
              {{-- kategori adı burada olacak --}}
            <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> 
              
              <a href="{{getKategoriUrl($kategori)}}" class="title_text">{{$kategori->name}}</a> 
            </h2>
             @php
                 $enHitHaber = $kategori->getHaberler()->where('eklenmeTarihi','<',Carbon\Carbon::now())->orderBy('hit','DESC')->first();
                //  dd($enHitHaber);
             @endphp
             {{-- kategori adı burada olacak --}}
            <div class="business_category_left wow fadeInDown">
                {{-- kategorinin en çok hit alan haberi  burada yayınlanacak --}}
              <ul class="fashion_catgnav">
                <li>
                 @if (isset($enHitHaber))
                     
                
                    @php
                   
                        $haberResim = $enHitHaber->getResim('390x240');
                    @endphp
                     @include('pages.anasayfa.components.components.hitHaber')
                     @endif
                </li>
              </ul>
               {{-- kategorinin en çok hit alan haberi  burada yayınlanacak --}}
            </div>
            <div class="business_category_right wow fadeInDown">
              <ul class="small_catg">
                  {{-- kategorinin geriye kalan haberleri burada yer alacak --}}
                  @php
                      $haberler = $kategori->getHaberler()->where('eklenmeTarihi','<',Carbon\Carbon::now())->orderBy('eklenmeTarihi','DESC')->limit(3)->get();
                  @endphp
                  @foreach ($haberler as  $haber)
                    @php
                        $haberResim = $haber->getResim('112x112');
                    @endphp   
                     @include('pages.anasayfa.components.components.hitOlmayanHaber')



                  @endforeach
                
                                {{-- kategorinin geriye kalan haberleri burada yer alacak --}}
               
               
              </ul>
            </div>
          </div>
        </div>