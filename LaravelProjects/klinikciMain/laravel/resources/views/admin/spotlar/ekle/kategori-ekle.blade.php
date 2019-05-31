@extends('/admin.master')



@section('icerik')
<div style="margin: auto" class="text-center container col-md-7">
    <div class="box box-primary">
        <div class="box-header">
        <h3 class="box-title">Spot Kategori Ekle</h3>
        </div><!-- /.box-header -->
        
        <!-- form start -->
        <form  action="/admin/spot/addKategori" method="POST"  enctype="multipart/form-data">
          @csrf
       
            
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
              <label for="exampleInputEmail1">Kategori ismi</label>
              <input  name="kategoriIsim" type="text" class="form-control" placeholder="İsim Giriniz">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Url</label>
            <input  name="kategoriUrl" type="text" class="form-control"  placeholder="Url">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Anahtar Kelimeler <span class="text-muted">',' ile ayırınız</span></label>
                <input required name="kategoriKeywords" type="text" class="form-control"  placeholder="anahtar Kelimeler">
              </div>
              <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input name="kategoriResim" type="file" id="exampleInputFile">
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