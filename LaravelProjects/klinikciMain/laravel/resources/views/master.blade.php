<!DOCTYPE HTML> @yield('language')


<head>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-7424510674102896",
        enable_page_level_ads: true
      });
    </script>

    
    @yield('title') 

   

 

    <link rel="icon" href="{{asset('favicon.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    @yield('keywords')
    @yield('description')
   
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta name="yandex-verification" content="8e1429663bdafa5a" />

      <!-- js-->
      <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>

    <!-- Bootstrap Core CSS -->
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    <!-- font-awesome icons -->
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }} " rel='stylesheet' type='text/css' />

    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- //webfonts -->

    @yield('css')
   
    
</head>

<body>

      

    <!-- header -->
    @include('components/header')
    <!-- //header -->
    <!-- banner -->

    <!-- buraya slider gelecek -->

    <!-- header sonu -->


    @yield('icerik')





    </div>
    <!-- footer top -->
    <!-- footer -->
    @include('components/footer')
    <!-- //footer -->
   
    <!-- subscribe form -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Subscribe now!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="email" class="form-control border" placeholder=" " name="email" id="usermail" required="">
                        </div>
                        <div class="right-w3l">
                            <input type="submit" class="form-control text-white" value="Subscribe">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //subscribe form -->




  

    <!--  scriptler girildi      -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>





    <!-- //subscribe form -->
    <!-- js-->

    <!-- move-top -->
    <script src="{{ asset('js/move-top.js') }}"></script>
    <!-- easing -->

    <!--  yukarı butonuna basınca yavaşça çıkmasını sağlıyor      -->
    <script src="{{ asset('js/easing.js') }}"></script>
    <!-- smooth scroll -->


    <!-- scroolun yavaş kaymasını sağlıyor -->
    <script src="{{ asset('js/SmoothScroll.min.js') }}"></script>
    <!--  necessary snippets for few javascript files -->


    <script src="{{ asset('js/stock.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->

    <script>
        addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
      

    @yield('js')

    <!--  scriptler girildi      -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125352856-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125352856-3');
</script>










</body>

</html>