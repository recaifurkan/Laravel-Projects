 <!-- header -->

 <header>
    <div class="container">
        <!-- nav -->
        <nav class="navbar navbar-expand-lg navbar-light py-4">
            <!-- logo -->
            <h1 id="logo-h1" style="width:200px;">
               
                <a class="navbar-brand" href="{{route('anasayfa')}}">
                    <img style='height:2.5rem;' src="{{asset('favicon.png')}}" alt="{{$siteBilgiler->site_name}}" title="{{$siteBilgiler->site_name}}">
                    {{$siteBilgiler->site_name}}
                    <small style="font-size:15px">.com</small>
                </a>
                
            </h1>
            <!-- //logo -->
            <button class="navbar-toggler ml-md-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- main nav -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-lg-auto text-center">


                    @foreach ($menuler as $menu )

                    <li class="nav-item active  mr-lg-3">
                    <a class="nav-link" href="{{route($menu->url)}}">{{$menu->name}}
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                        
                    @endforeach
                    <!-- menilerin başlangıcı         -->
                   



                    <!--        giriş işlemi yapılacak yer            -->
                    <li>
                        
                        @if (!Auth::check())
                       
                        
                        <button id="loginButton" type="button" class="btn btn-danger ml-lg-5 w3ls-btn" data-toggle="modal" aria-pressed="false" data-target="#exampleModel">
                                Giriş Yap
                            </button>
                            

                        @else()
                    {{-- kullanıcı giriş yapmışsa bu alan gösterilcek  --}}

                    <li class="dropdown nav-item active"> 
                            
                            <a href="#" data-toggle="dropdown" class="btn btn-danger ml-lg-5 w3ls-btn ">
                                
                                <img width="30px" height="30px" class="profil-image" 
                                src="{{route('profilResim',['uyeId'=>Auth::user()->id])}}" 
                                alt="{{isset(Auth::user()->name) ? Auth::user()->name: Auth::user()->kullanici_adi }}">   
                               
                                <span class="caret"> {{Auth::user()->name}}</span>
                            </a>
                            @php
                            $uyeIsAdmin = false;
                                foreach (Auth::user()->roller as $rol) {
                                   if($rol->id != 1){
                                    $uyeIsAdmin = true;
                                   }
                                  
                                }
                            @endphp
                            
                            <ul class="dropdown-menu multi-level" role="menu">
                                <li class="nav-item">
                                        <a class="dropdown-item" href="/uyeProfil">
                                                Profili düzenle
                                        </a>
                                    </li>
                                @if ($uyeIsAdmin)
                                <li class="nav-item">
                                    <a class="dropdown-item" href="/admin/anasayfa">
                                            Admin Sayfası
                                    </a>
                                </li>
                                        @endif
                               <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     Çıkış yap
                                 </a>

                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf
                                 </form>
                                </li>
                            </ul>
                        </li>
      
                            
                        @endif
                       
                    </li>
                </ul>
            </div>
            <!-- //main nav -->
        </nav>
        <!-- //nav -->
    </div>
</header>
<!-- //header -->

@if (!Auth::check())

    
<!-- Login modal -->
<div class="modal fade" id="exampleModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Login</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" id="loginForm" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
       
       <div id="messagesLogin"></div>
       
<div class="form-group">
       
    <label for="email" class="col-sm-4 col-form-label text-md-right">E-mailiniz</label>
    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
</div>
<div class="form-group">
        <label for="password" class="col-md-4 col-form-label text-md-right">Şifreniz</label>
        <input id="password" type="password" class="form-control" name="password" required>

        
</div>
<div class="col text-center sub-agile">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" for="remember">
            Beni hatırla
        </label>
</div>
<div style="margin-top: 15px;" class="right-w3l">
    <input type="submit" class="form-control border text-white" value="Giriş yap">
</div>
<div style="margin-top:10px" class="col-md-12 text-center row" >
    <div class="col-md-4">
        <a 
        href="{{route('loginRequest',['network'=>'facebook'])}}"
        ><i style="color:#47639E" class="fab fa-facebook fa-4x"></i></a>
        {{-- <p>Çok yakında</p> --}}
    </div>
    <div class="col-md-4">
        <a 
        {{-- href="{{route('loginRequest',['network'=>'twitter'])}}" --}}
        ><i style="color:#00ACED" class="fab fa-twitter fa-4x"></i></a>
        <p>Çok yakında</p>
    </div>
    <div class="col-md-4">
        <a href="{{route('loginRequest',['network'=>'google'])}}">
            <i style="color:#DC4A38" class="fab fa-google-plus-g fa-4x"></i></a>
    </div>
</div>
<div class="row sub-w3l col-md-12">
    
    <div class=" text-center  col-md-12  text-dark">
            <a class="btn btn-link" href="{{ route('password.request') }}">
                   Şifreni hatırlamıyor musun?
                </a>
            </div>
        </div>

        @php
if(Session()->get('girisYap'))
    $girisYap = Session()->get('girisYap');
@endphp
@if (!Auth::check() && isset($girisYap))


<script>
        $(function(){
        $('#loginButton').click();
        // alert('recai');
        // eğer üye girişi yapması gerek yere girerse üye giriş açılsın diye yazıldı
        });
        </script>
@endif


                <script>
        
        $('#loginForm').submit(function(e){

            console.log('tiklandi');
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: $(this).attr('method'), 
                url:  $(this).attr('action'), 
                data: $(this).serialize(), 
                success: function(data){
                    if(data == 'true'){
                        location.reload();
                    }
                    else if(data == 'banned'){
                        // console.log(data);
                        window.location = "/iletisim?banned=banned";
                    }
                    
                    // console.log(data);
                    
                    },
                error: function (xhr, ajaxOptions, thrownError) { 
                    $response = JSON.parse(xhr.responseText);
                    // console.log($response);
                    $errors = $response.errors;
                    $errorEmail = $errors.email;
                    text = '';
                    Object.keys($errors).forEach(function(error , index) {
                        Object.keys($errors[error]).forEach(function(value , index) {
                       
                       text += $errors[error][value] + '<br>';
                    //    console.log($errors[error][value]);


                   });
                        
                        
                       
                    })

                     $('#messagesLogin').html(text).addClass('alert alert-danger');

                    // console.log(text);
                    // console.log($response.message);
                    //  console.log(thrownError);
                        
                    }
                 
            });
        
        });
                
                
                
                
                </script>
   
<p class="text-center">Hesabınız Yok mu?
    <a href="#" data-toggle="modal" data-target="#exampleModal1" class="text-dark font-weight-bold">
        Hesap oluştur</a>
</p>
</form>
</div>
</div>
</div>
</div>
<!-- //Login modal -->
<!-- Register modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel1">Register</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" id="registerForm" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
    
    <div   id="messagesRegister"></div>
<div class="form-group">
    <label for="recipient-name" class="col-form-label">Kullanıcı Adı</label>
    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
</div>
<div class="form-group">
    <label for="recipient-email" class="col-form-label">E-mail</label>
    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
</div>
<div class="form-group">
    <label for="password1" class="col-form-label">Şifre</label>
    <input id="password" type="password" class="form-control" name="password" required>
</div>
<div class="form-group">
    <label for="password2" class="col-form-label">Şifrenizi tekrar giriniz</label>
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
</div>

          
                                    
                                    


<div class="sub-w3l">
    <div class="sub-agile">
        <input type="checkbox" id="brand2" value="">
        <label for="brand2" class="mb-3">
                                    <span></span>Okudum ve şartları kabul ediyorum</label>
    </div>
</div>
<div class="right-w3l">
        <button type="submit" class="btn btn-primary">
                Gönder
            </button>
</div>
<script>
        
        $('#registerForm').submit(function(e){

            console.log('tiklandi');
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: $(this).attr('method'), 
                url:  $(this).attr('action'), 
                data: $(this).serialize(), 
                success: function(data){
                    if(data == 'true'){
                        location.reload();
                    }
                  
                    // console.log(data);
                    
                    },
                error: function (xhr, ajaxOptions, thrownError) { 
                   var $response = JSON.parse(xhr.responseText);
                   var $errors = $response.errors;
                   var $errorEmail = $errors.email;
                   var text = '';
                    console.log($response);
                  
                        Object.keys($errors).forEach(function(error , index) {
                            Object.keys($errors[error]).forEach(function(value , index) {
                        
                                text += $errors[error][value] + '<br>';
                                // console.log($errors[error][value]);


                            });
                            });
                       

                     $('#messagesRegister').html(text).addClass('alert alert-danger');


                
                //    console.log($errors);
                // foreach($errors as $error){
                //     console.log($error);
                // }
                    

                    // $('#messagesRegister').html($errorEmail).addClass('alert alert-danger');
                    // console.log(text);
                    // console.log($response.message);
                    //  console.log(thrownError);
                        
                    }
                 
            });
        
        });
              
                
                </script>
</form>
</div>
</div>
</div>
</div>
<!-- // Register modal -->

@endif

