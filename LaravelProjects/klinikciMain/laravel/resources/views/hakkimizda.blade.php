@extends('master') 
@section('language')
<html lang="tr">
@endsection






<!--  başlık belirtilecek  -->


@section('title')
<title>Hakkımızda : Klinikçi</title>
@endsection



<!-- keywordlar belirtilecek -->


@section('keywords')
<meta name="keywords" content="---------------" />
@endsection
 
@section('css') 
@section('icerik')




<div class="container">
<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">Anasayfa</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Hakkımızda</li>
        </ol>
    </nav>
    <!-- //breadcrumbs -->

</div>


<!-- banner bottom -->
<section class="w3ls-bnrbtm py-5" id="w3layouts_bnrbtm">
    <!-- title description  -->
    <div class="container py-sm-5">
        <div class="row pt-lg-5">
            <div class="col-lg-5  bb-left">

                <h3 class="agile-title">Misyonumuz</h3>
            </div>
            <div class="col-lg-7 mt-lg-0 mt-3 px-lg-5">
                <p>Donec consequat sapien ut leo cursus rhoncus. Nullam dui mi, vulputate ac metus at, semper varius orci. Nulla
                    accumsan ac elit in congue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                    Class aptent taciti sociosqu ad litora torquent p himenaeos.</p>

            </div>
        </div>
    </div>
    <!-- //title description  -->
</section>
<!-- //banner bottom -->

<section class="w3ls-bnrbtm py-5" id="w3layouts_bnrbtm">
    <!-- title description  -->
    <div class="container py-sm-5">
        <div class="row pt-lg-5">
            <div class="col-lg-5  bb-left">
                <p>Donec consequat sapien ut leo cursus rhoncus. Nullam dui mi, vulputate ac metus at, semper varius orci. Nulla
                    accumsan ac elit in congue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                    Class aptent taciti sociosqu ad litora torquent p himenaeos.</p>

            </div>
            <div class="col-lg-7 mt-lg-0 mt-3 px-lg-5">


                <h3 class="agile-title">Vizyonumuz</h3>


            </div>
        </div>
    </div>
    <!-- //title description  -->
</section>
<!-- //banner bottom -->

<!-- //case studies -->
<!-- footer top -->
<section class="footerw3-top py-lg-5">
    <div class="container py-md-5">

        <center class="feed-title my-3">Burada Neler Yapabilirsiniz... </center>
        <!-- footer top row -->
        <div style="text-align: center;" class="row py-5 justify-content-center">




            <div class="col-md-6 my-md-0 my-4 ">
                <img src="images/f2.png" alt="" class="img-fluid">
                <h4 class="feed-title my-3">
                    <span>Yorumlar yapabilirsininz</span>
                </h4>

            </div>



            <div class="col-md-6 ">
                <img src="images/f3.png" alt="" class="img-fluid">
                <h4 class="feed-title my-3">Bilgi paylaşımı yapabilirsiniz

                </h4>

            </div>

        </div>
        <!-- //footer top row -->
    </div>
</section>
@endsection
 
@section('js')
@endsection