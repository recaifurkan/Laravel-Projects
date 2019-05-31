<div style="margin-top: 10px;" class="text-center">
    <h3>Hadi paylaşın !</h3>
    @include('components.paylas.shareButtons')
    
</div>
<footer class="py-sm-5">
    <div class="container">
        <div class="row py-5">
            <!-- footer grid1 -->
            <div class="col-lg-4 col-sm-6">
                <h2>
                    <a class="navbar-brand" href="{{route('anasayfa')}}">
                        <img style='height:2.5rem;' src="{{asset('favicon.png')}}" alt="{{$siteBilgiler->site_name}}" title="{{$siteBilgiler->site_name}}">
                        {{$siteBilgiler->site_name}}
                    </a>
                </h2>
                <div class="fv3-contact mt-3">

                    <p>Sağlığa Dair Herşey...</p>
                </div>


            </div>
            <!-- //footer grid1 -->
            <!-- footer grid2 -->
            <div class="col-lg-4  col-sm-6 footv3-left text-lg-center my-sm-0 mt-5">
                <h3 class="mb-3">Site Hizmetleri</h3>
                <ul class="list-agileits">
                   
                   @foreach ($siteHizmetler as $siteHizmet )
                   <li>
                    <a href="{{route($siteHizmet->link)}}">
                        {{$siteHizmet->name}}
                    </a>
                </li>
                   @endforeach
                    
                   

                </ul>
            </div>
            <!-- //footer grid2 -->
            <!-- footer grid3 -->
            <div class="col-lg-4  col-sm-6 footv3-left text-lg-center my-lg-0 mt-sm-5 mt-5">
                <h3 class="mb-3">Linkler</h3>

                <ul class="list-agileits">
                        <li>
                                <a href="{{route('privacy-policy-tr')}}">
                                    Gizlilik politikası
                                </a>
                            </li>
                <!--     buraya menüler gelecek      -->

                @foreach ($menuler as $menu )

               
                    <li>
                        <a href="{{route($menu->url)}}">
                            {{$menu->name}}
                        </a>
                    </li>
                        
                    @endforeach

                


                </ul>
            </div>




            <!-- //footer grid3 -->
            <!-- footer grid4  -->
            
            <!-- //footer grid4 -->
        </div>

       
        <div class="cpy-right text-center  pt-5 pb-sm-0 pb-3">
            <p class="text-secondary">© 2018 Klinikci.com Tüm hakları saklıdır |
                <span  class="text-white"> RFB Yazılım</span> Tarafından dizayn edilmiştir

            </p>
        </div>
    </div>
    <!-- //footer container -->
</footer>



