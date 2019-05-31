<header id="header">
    <div class="row">
      <div class="col-md-12">
        <div class="header_top">
            <div class="row col-md-12">
                <div class="col-md-4 text-left">
                        <ul class="top_nav">
                                <li><a href="/">Home</a></li>
                               
                                <li><a href="/contact">Contact</a></li>
                               
                              </ul>
                </div>
                <div class="col-md-4 text-center">
                        <a class="logo" href="/">recent <strong>Hub</strong> <span>Real hub of the last news</span></a>
                </div>
                <div class="col-md-4 text-right">
                        <form action="/search" method="get" class="search_form">
                            @csrf
                            <input type="text" name="search" placeholder="Text to Search">
                            <input type="submit" value="">
                          </form>
                </div>
            </div>
          
          <!-- <div class="header_bottom_right"><a href="/#"><img src="/images/addbanner_728x90_V1.jpg" alt=""></a></div> -->
        </div>
        <div class="header_bottom">
          
          <div class="header_bottom_right" id="navarea">
            <nav class="navbar navbar-default" role="navigation">
              {{-- <div class="container-fluid"> --}}
                
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                  <div id="navbar" class="navbar-collapse collapse ">
                        <ul class="nav text-center navbar-nav custom_nav">
                          <li class=""><a href="/">Home</a></li>
                          <li class="dropdown dropdown1"> <a href="/#" class="" data-toggle="dropdown1" role="button" aria-expanded="false">Categories</a>
                            <ul  class="dropdown-menu" role="menu">
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
                          </li>
                          
                          <li><a href="/contact">Contact</a></li>
                         
                        </ul>
                      </div>
                
               
              {{-- </div> --}}
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>