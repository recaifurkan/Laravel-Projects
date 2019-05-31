<!DOCTYPE html>
<html>
<head>
    
@yield('title')
<link rel="icon" href="{{asset('favicon.ico')}}">
 
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@yield('meta')
<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="/assets/css/slick.css">
<link rel="stylesheet" type="text/css" href="/assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
@yield('css')
<!--[if lt IE 9]>
<script src="/assets/js/html5shiv.min.js"></script>
<script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({
                  google_ad_client: "ca-pub-7424510674102896",
                  enable_page_level_ads: true
             });
        </script>
</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="/#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  @include('layouts.components.header')
  @yield('icerik')

  
</div>
@include('layouts.components.footer')
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125352856-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125352856-4');
</script>

<script src="/assets/js/jquery.min.js"></script> 
<script src="/assets/js/bootstrap.min.js"></script> 
<script src="/assets/js/wow.min.js"></script> 
<script src="/assets/js/slick.min.js"></script> 
<script src="/assets/js/custom.js"></script>
@yield('js')
</body>
</html>