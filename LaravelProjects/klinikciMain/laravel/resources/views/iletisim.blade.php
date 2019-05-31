@extends('master') 
@section('language')
<html lang="tr">
@endsection






<!--  başlık belirtilecek  -->


@section('title')
@php
    $title = 'İletişim : Klinikçi';
@endphp
<title>{{$title}}</title>
@endsection



<!-- keywordlar belirtilecek -->


@section('keywords')
<meta name="keywords" content="---------------" />
@endsection
 
@section('css')
@endsection
 
@section('icerik')



    <!-- inner banner -->
    
   
           

            @if(isset($response))
            <style>
                html,
                body {
                    background-color: #fff;
                    color: #636b6f;
                    font-family: 'Raleway', sans-serif;
                    font-weight: 100;
                    height: 100vh;
                    margin: 0;
                }
        
                .full-height {
                    height: 80vh;
                }
        
                .flex-center {
                    align-items: center;
                    display: flex;
                    justify-content: center;
                }
        
                .position-ref {
                    position: relative;
                }
        
                .top-right {
                    position: absolute;
                    right: 10px;
                    top: 18px;
                }
        
                .content {
                    text-align: center;
                }
        
                .title {
                    font-size: 84px;
                }
        
                .links>a {
                    color: #636b6f;
                    padding: 0 25px;
                    font-size: 12px;
                    font-weight: 600;
                    letter-spacing: .1rem;
                    text-decoration: none;
                    text-transform: uppercase;
                }
        
                .m-b-md {
                    margin-bottom: 30px;
                }
            </style>
        </head>
        
        <body>
            
            
            @if(isset($response['error']))
            <div class="flex-center  text-center alert  alert-danger position-ref full-height">
            
                <div class="title m-b-md">
                <h5>{{$response['error']}}</h5>
                </div>
            </div>
            @else 
            <div class="flex-center  text-center alert alert-succes position-ref full-height">
            
                <div class="title m-b-md">
                <h5>{{$response['succes']}}</h5>
                </div>
            </div>
           
            @endif
             
            
            
            
        
        

            @else 
            <body>

        <div class="container">
              <!-- breadcrumbs -->
              <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Anasayfa</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                                İletişim
                        </li>
                    </ol>
                </nav>
                <!-- //breadcrumbs -->

        </div>
          
            <!-- contact -->
            @if (isset($banned))
            <div style="margin: auto;font-size: 25px " class=" text-center alert-danger ">
                Görünüşe göre üyeliğiniz engellenmiş. Bir yanlışlık olduğunu düşünüyorsanız lütfen alttaki forumdan iletişime geçiniz...
                </div>
            @endif
            

            <section class="wthree-row w3-contact" id="contact">
                <div class="container py-sm-5 py-4">

             <!-- title description  -->
             <div class="row py-md-5 pb-3">
                <div class="col-lg-5  bb-left">
                    <span class="w3-line">Merhaba deyin</span>
                    <h3 class="agile-title">Bizimle iletişime Geçin</h3>
                </div>
                <div class="col-lg-7 mt-lg-0 mt-3 px-lg-5">
                    <p>Aklınıza gelebilecek her türlü sorun, görüş,destek için bize buradan ulaşabilirsiniz. En kısa sürede
                        geri dönüş yapılacaktır.</p>
                </div>
            </div>
            <!-- //title description  -->

            <!-- contact details -->
            <div class="row contact-form p-sm-5 p-3">

                <!-- contact right grid -->
                <div class="col-lg-12 wthree-form-left mt-lg-0 mt-3">
                    <!-- contact form grid -->
                    <div class="contact-top1">
                        <h5 class="my-3">Bize bir mesaj gönderin</h5>
                        <form action="/iletisimMesaj" method="post" class="f-color pt-3">
                            @csrf
                            @if(count($errors)>0)
                            @foreach ($errors as $error)
                            <div class='alert alert-danger'>{{$error}}    </div>
                            @endforeach
                
                        @endif
                            <div   id="messagesLogin"></div>
                            <div class="form-group">
                                <label for="contactusername">İsim</label>
                                <input type="text" name="name" class="form-control" id="contactusername" required>
                            </div>
                            <div class="form-group my-4">
                                <label for="contactemail">E-mail</label>
                                <input type="email" name="email" class="form-control" id="contactemail" required>
                            </div>
                            <div class="form-group">
                                <label for="konuusername">Konu</label>
                                <input type="text" name="konu" class="form-control" id="konuusername" required>
                            </div>
                            <div class="form-group">
                                <label for="contactcomment">Mesajınız</label>
                                <textarea class="form-control" name="mesaj" rows="5" id="contactcomment" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block">Gönder</button>
                        </form>
                    </div>
                </div>
                <!--  //contact right grid -->
            </div>
            <!-- //contact details  -->
            @endif
        </div>
    </section>
    <!-- //contact -->
@endsection
 
@section('js')
@endsection