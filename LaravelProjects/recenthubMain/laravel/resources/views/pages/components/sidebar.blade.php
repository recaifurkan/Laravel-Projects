
        <div class="content_bottom_right">
          
          <div class="single_bottom_rightbar">
            <ul role="tablist" class="nav nav-tabs custom-tabs">
              <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="/#mostPopular">Most Popular</a></li>
              <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="messages" href="/#recentComent">Recent Comment</a></li>
            </ul>
            <div class="tab-content">
              <div id="mostPopular" class="tab-pane fade in active" role="tabpanel">
                <ul class="small_catg popular_catg wow fadeInDown">
                    {{-- en çok hit alan haberler yer alacak --}}
                    @foreach ($enCokHitAlanHaberler as $haber)
                    <li>
                    <div class="media wow fadeInDown"> <a class="media-left" href="{{getHaberUrl($haber)}}">
                      <img width="{{$haber->getResim('112x112')->width}}" heigh="{{$haber->getResim('112x112')->height}}" src="{{src($haber->getResim('112x112')->url)}}" alt="{{$haber->getResim('112x112')->aciklama}}"></a>
                          <div class="media-body">
                            <h4 class="media-heading"><a href="{{getHaberUrl($haber)}}">{{$haber->baslik}} </a></h4>
                            {{$haber->kisaAciklama}}
                          </div>
                        </div>
                      </li>
                    @endforeach
                 
                 
                    {{-- en çok hit alan haberler yer alacak --}}
                </ul>
              </div>
              <div id="recentComent" class="tab-pane fade" role="tabpanel">
                  {{-- en son görüntülenen haberler yer alacak --}}
                <ul class="small_catg popular_catg">

                  @foreach ($enSonBakilanHaberler as $haber)
                  <li>
                  <div class="media wow fadeInDown"> <a class="media-left" href="{{getHaberUrl($haber)}}">
                        <img width="{{$haber->getResim('112x112')->width}}" heigh="{{$haber->getResim('112x112')->height}}" src="{{src($haber->getResim('112x112')->url)}}" alt="{{$haber->getResim('112x112')->aciklama}}"></a>
                        <div class="media-body">
                          <h4 class="media-heading"><a href="{{getHaberUrl($haber)}}">{{$haber->baslik}} </a></h4>
                          {{$haber->kisaAciklama}}
                        </div>
                      </div>
                    </li>
                  @endforeach
                 


                </ul>
                  {{-- en son görüntülenen haberler yer alacak --}}
              </div>
            </div>
          </div>
         
          <div class="single_bottom_rightbar wow fadeInDown">
            <h2>Categories</h2>
            <ul>
                    @foreach ($kategoriler as $kategori)
                    @if ($kategori->getAltKategoriler()->count()==0)
                        @if ($kategori->getUstKategori()->count()==0)
                            <li>
                                <a href="{{getKategoriUrl($kategori)}}">{{ilkHarfBuyuk($kategori->name)}}</a>
                            </li>
                        @endif
                        
                    
                       
                    @else
                        <li>
                            <a href="{{getKategoriUrl($kategori)}}">{{ilkHarfBuyuk($kategori->name)}}</a>
                        </li>
                        @foreach ($kategori->getAltKategoriler as $altKategori) 
                            @if (getKategoriHaberler($altKategori)->count()>0)
                                <li><a href="{{getKategoriUrl($altKategori)}}"> <span> → </span> {{ilkHarfBuyuk($altKategori->name)}}</a></li>
                            @endif
                        @endforeach
                       
                    @endif
                    
                
                  @endforeach
             
             
             
              
            </ul>
          </div>
        </div>
  