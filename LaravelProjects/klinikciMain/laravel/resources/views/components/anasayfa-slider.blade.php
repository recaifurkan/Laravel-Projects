@if ($sliderler->count()>0)
    

<section class="slider">

    <script src="js/slider.js"></script>
    <link href="css/slider.css" rel='stylesheet' type='text/css' />


    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
       
        <div class="slider_sol" data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">

            <!-- slayt tekrar ettirilecek     -->

            @foreach ($sliderler as $slayt )
            <div>
               @if (strlen($slayt->linkUrl)>0)
                    <a href="{{$slayt->linkUrl}}">
                            <img data-u="image"  src="{{asset('storage/assets').'/'.$slayt->resim->url}}" />
                    </a>
               @else
               <img data-u="image"  src="{{asset('storage/assets').'/'.$slayt->resim->url}}" />
               @endif
              
               
            </div>
            @endforeach

           


        </div>
        
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb111" style="position:absolute;bottom:12px;right:12px;" data-scale="0.5">
            <div data-u="prototype" class="i" style="width:24px;height:24px;font-size:12px;line-height:24px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1;">
                <circle class="b" cx="8000" cy="8000" r="3000"></circle>
            </svg>
                <div data-u="numbertemplate" class="n"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jssor_1_slider_init();
    </script>
    <!-- #endregion Jssor Slider End -->



</section>

@endif
