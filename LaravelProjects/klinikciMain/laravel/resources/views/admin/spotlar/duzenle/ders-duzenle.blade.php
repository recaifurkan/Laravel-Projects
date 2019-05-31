@extends('/admin.master')



@section('icerik')
<div style="margin: auto" class="text-center container col-md-7">
    <div class="box box-primary">
        <div class="box-header">
        <h3 class="box-title">Spot Ders : {{$ders->name}}</h3>
        </div><!-- /.box-header -->
        <div>  
           
       @if (isset($ders->resim))
       <img width="100px" height="100px" class="card-img-bottom spotAnasayfa" src="{{asset('storage/assets').'/'.$ders->resim->url}}" alt="{{$ders->resim->aciklama}}">
       @endif
          
      </div>
        <!-- form start -->
        <form  action="/admin/spot/editDers" method="POST"  enctype="multipart/form-data">
          @csrf
            <input type="hidden" value="{{$ders->id}}" name="dersId">
          <div class="box-body">

              {{-- validasyon hataları ekleniyor --}}
              @php
              if(session()->get('hatalar')){
               $hatalar = session()->get('hatalar');
              }

              if(session()->get('succes')){
               $succes = session()->get('succes');
              }
                  
              @endphp
                @if(isset($hatalar))
              <div class="alert-danger" >                 
                @foreach ($hatalar as $error)
                {{$error}}                      
                @endforeach
              </div>
              @endif
              
              {{-- başarılı bir şekilde kayıt yapıldı mı o göstermek için  --}}
              
             
              @if(isset($succes))
             
              <div class="alert-success" >
                  {{$succes}}
               </div>
             
             
                @endif
             
            <div class="form-group">
              <label for="exampleInputEmail1">Ders ismi</label>
              <input value="{{$ders->name}}" name="dersIsim" type="text" class="form-control" placeholder="İsim Giriniz">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Açıklaması</label>
            <input value="{{$ders->aciklama}}" name="dersAciklama" type="text" class="form-control"  placeholder="Açıklama">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Url </label>
                <input value="{{$ders->url}}" name="dersUrl" type="text" class="form-control"  placeholder="url">
              </div>
              
              <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input name="dersResim" type="file" id="exampleInputFile">
                    <p class="help-block">Resim Seç</p>
                  </div>
           
          
          </div><!-- /.box-body -->
    
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div><!-- /.box -->

</div>






    
@endsection