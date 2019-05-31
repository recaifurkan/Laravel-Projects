{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
@extends('master')
@section('title')
<title>Profil :  {{isset($uye->kullanici_adi) ? $uye->kullanici_adi : $uye->name }}</title>
    
@endsection

@section('css')

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
@endsection


@section('icerik')

<div class="container bootstrap snippet">
        <div class="row">
                
        <div class="col-sm-10 text-right"><h1><span class="alert-success">Merhaba ! </span>{{isset($uye->kullanici_adi)?$uye->kullanici_adi:$uye->name}}</h1></div>
           
        </div>
        @include('showErrorsSucces')
        <form class="form" action="/uyeProfil" method="post" id="registrationForm" enctype="multipart/form-data">
            @csrf
        <div class="row"> 
            
               
              <div class="col-sm-3"><!--left col-->
              
               
          <div class="text-center">
            <img src="{{route('profilResim',['uyeId'=>Auth::user()->id])}}" class="avatar img-circle img-thumbnail" alt="{{isset(Auth::user()->name) ? Auth::user()->name: Auth::user()->kullanici_adi }}">
            <h6>Profil Fotoğrafını Değiştir</h6>
            <input type="file" name="profilImage" class="text-center center-block file-upload">
          </div><hr><br>
    
                   
             
              
              
              <ul class="list-group">
                <li class="list-group-item text-muted">Aktiviteler <i class="fa fa-dashboard fa-1x"></i></li>
              <li class="list-group-item text-right"><span class="pull-left"><strong>Beğenilen Konu Mesaj</strong></span> {{$uye->begenilenKonuMesajlar->count()}}</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Beğenilen Konu</strong></span> {{$uye->begenilenKonular->count()}}</li>
              <li class="list-group-item text-right"><span class="pull-left"><strong>Beğenilen Spot Sayısı</strong></span>{{$uye->begenilenSpotlar->count()}}</li>
 
              </ul> 
                   
              {{-- <div class="panel panel-default">
                <div class="panel-heading">Social Media</div>
                <div class="panel-body">
                    <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
                </div>
              </div> --}}
              
            </div><!--/col-3-->
            <div class="col-sm-9">
               
    
                  
              <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    
                          <div class="row">
                              
                        <div class="col-md-6"><div class="form-group">
                              
                                <div class="col-xs-6">
                                    <label for="first_name"><h4>Adınız</h4></label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{$uye->name}}" title="enter your first name if any.">
                                </div>
                            </div>
                            <div class="form-group">
                                
                                <div class="col-xs-6">
                                  <label for="last_name"><h4>Soyadınız</h4></label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{$uye->soyad}}" title="enter your last name if any.">
                                </div>
                            </div>
                
                            <div class="form-group">
                                
                                <div class="col-xs-6">
                                    <label for="phone"><h4>Kullanıcı Adınız</h4></label>
                                <input type="text" class="form-control" name="kullaniciAdi" id="phone" value="{{$uye->kullanici_adi}}" title="enter your phone number if any.">
                                </div>
                            </div>
                
                            <div class="form-group"> 
                                <div class="col-xs-6">
                                   <label for="mobile"><h4>Haber almak İstediğiniz sınav</h4></label>
                                    
                                    <select class="form-control" name="uyeSinav">
                                        <option {{isset($uye->sinav->id) ? '':'selected'}} value="0">Sınav Seç</option>
                                    @foreach ($sinavlar as $sinav)
                                        <option {{isset($uye->sinav->id) ? ($uye->sinav->id == $sinav->id ? 'selected':''):''}} value="{{$sinav->id}}">{{$sinav->sinav_tur}}</option>    
                                    @endforeach
                                    </select>
                                       
                                    
                                </div>
                            </div>
                        
                        </div>
                        <div class="col-md-6" >
                                <div class="form-group">
                              
                                        <div class="col-xs-6">
                                            <label for="email"><h4>Email</h4></label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{$uye->email}}" title="enter your email.">
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        
                                        <div class="col-xs-6">
                                            <label for="password"><h4>Şifreniz</h4></label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Şifreniz" title="Şifrenizi giriniz">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        
                                        <div class="col-xs-6">
                                          <label for="password2"><h4>Şifre Tekrarı</h4></label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password2" placeholder="Şifre tekrarla" title="Şifrenizi giriniz">
                                        </div>
                                    </div></div>  
                                </div>
                        
                        
                          
                          <div class="form-group">
                               <div class="col-xs-12">
                                    <br>
                                      <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                     
                                </div>
                          </div>
                      
                  
                  <hr>
                  
                 </div><!--/tab-pane-->
                </form>
                 
                   
                  </div><!--/tab-pane-->
              </div><!--/tab-content-->
    
            </div><!--/col-9-->
        </div><!--/row-->
    
@endsection

@section('js')
<script>
    $(document).ready(function() {

    
var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.avatar').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(".file-upload").on('change', function(){
    readURL(this);
});
});

</script>

    
@endsection