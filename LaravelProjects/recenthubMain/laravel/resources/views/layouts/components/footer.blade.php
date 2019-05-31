<footer id="footer">
        
    <div class="footer_top">
            
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="single_footer_top wow fadeInLeft">
              <h2>Flicker News</h2>
              <ul class="flicker_nav">
                {{-- haberlerin 75*75 lik resimleri burada olacak randomize seçilecek --}}
                @foreach ($haberler as $haber)
                @php
                    $haberResim = $haber->getResim('75x75');
                @endphp
                <li>
                  <a href="{{getHaberUrl($haber)}}">
                    <img width="{{$haberResim->width}}" 
                  heigh="{{$haberResim->height}}" 
                  src="{{src($haberResim->url)}}" alt="{{$haberResim->aciklama}}"></a></li>
                @endforeach
               
                 {{-- haberlerin 75*75 lik resimleri burada olacak randomize seçilecek --}}
               
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="single_footer_top wow fadeInDown">
              <h2>Categories</h2>
              <ul class="labels_nav">
                {{-- kategoriler burada da sıralanacak --}}
                @foreach ($kategoriler as $kategori)
                    @if (getKategoriHaberler($kategori)->count()>0)
                        <li><a href="{{getKategoriUrl($kategori)}}">{{$kategori->name}}</a></li>
                    @endif
              
                @endforeach
               
                {{-- kategoriler burada da sıralanacak --}}
                
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="single_footer_top wow fadeInRight">
              <h2>About Us</h2>
              <p>We Serve Latest News All Time </p>
              <div><a href="{{route('privacy-policy')}}">Privacy Policy</a></div>
            </div>
          </div>
        </div>
      </div>
      <div style="margin-top: 20px;" class="text-center" >
            <h2 style="color:white">Share to Your Friends!</h2>
                 
              @include('pages.components.paylas.shareButtons')
        
      </div>
    </div>
    
    <div class="footer_bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="footer_bottom_left">
              <p>Copyright &copy; 2018 <a href="/">recentHub</a></p>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="footer_bottom_right">
              <p>Developed Rfb Software</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>