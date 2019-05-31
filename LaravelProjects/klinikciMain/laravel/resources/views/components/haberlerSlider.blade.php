<!-- left grid -->
<div class="col-lg-3 ">
        <!-- Search Widget -->
       


        <!-- arama sonuçları -->
       
        @include('components.haberArama')

        <!-- arama sonucunda açılacak yer -->


        <!-- Categories Widget -->
        <div class="card my-4">
            <h5 class="card-header">Kategoriler</h5>
            <div class="card-body">
                <ul class="w3-tag2">

                    @foreach ($haberKategoriler as $kategori)
                        <!--     kategorilerd etekrar ettirilecekle burası       -->
                    <li>
                    <a href="/haber/{{trim($kategori->url)}}">
                        <i class="fa fa-angle-right mr-2"></i>{{ilkHarfBuyuk($kategori->name)}}</a>
                    </li>

                    <!--     kategorilerd etekrar ettirilecekle burası       -->
                    @endforeach
                    

                </ul>
            </div>
        </div>
        <!-- Side Widget -->



        <!-- latest post -->
        <div class="card my-4 p-3 post_link">
            <h5 class="card-header">En son Haberler</h5>

            @foreach ($enSonHaberler as $haber)

             <!-- en son haberlerde tekrar ettirilecek yer          -->
             <div class="row mt-3">
                <div class="col-4">
                <a href="/haber/{{trim($haber->kategori->url)}}/{{trim($haber->url)}}">
                   
                        <img class="card-img-bottom" src="{{asset('storage/assets').'/'.$haber->kapakResim->url}}" alt="{{$haber->kapakresim->aciklama}}">
                    
                    </a>
                </div>
                <div class="col-8 pl-0">
                <a href="/haber/{{trim($haber->kategori->url)}}/{{trim($haber->url)}}">{{ilkHarfBuyuk($haber->baslik)}}</a>
                    <p class="card-text">
                    <small class="text-muted">{{getAgo($haber->eklenme_tarihi)}}</small>
                    </p>
                </div>
            </div>

            <!-- en son haberlerde tekrar ettirilecek yer          -->
                
            @endforeach
           

        </div>
    </div>
    <!-- //left grid -->



    



   