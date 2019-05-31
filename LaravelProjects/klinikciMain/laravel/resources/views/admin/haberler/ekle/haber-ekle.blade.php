@extends('/admin.master')

@section('css')

<style>
.showImage{
  width: 100px;
  height: 100px;
}
</style>
    
@endsection

@section('icerik')
<div style="margin: auto" class="text-center container col-md-7">
    
        <!-- form start -->
        @php
         $resimler = null;
        if(session()->get('resimler')){
          $resimler = session()->get('resimler');
            // var_dump($resimler);

        }
        if(session()->get('haber')){
          $haber = session()->get('haber');
        }
           
        @endphp

        @if (!isset($resimler))
        <form  action="/admin/haber/addHaber" method="POST"  enctype="multipart/form-data">
          @csrf
            <input type="hidden" value="{{$kategori->id}}" name="kategoriId">
          <div class="box-body">

              {{-- validasyon hataları ekleniyor --}}
              @include('admin.showErrorsSucces')

              <div class="form-group">
                <label for="exampleInputEmail1">Haber Başlığı</label>
              <input value="{{old('haberBaslik')}}"  name="haberBaslik" type="text" class="form-control" placeholder="Başlık Giriniz">
              </div>
             
                
                <div class="form-group">
                  <label for="exampleInputFile">Haber içerikte kullanılacak Resimleri seçiniz</label>
                  <input value="{{old('dersResim')}}"  multiple name="haberResimler[]" type="file" id="exampleInputFile">
                 
                </div>

          </div><!-- /.box-body -->
    
          <div class="box-footer">
            <button type="submit" value="Submit" name="haberResimlerSubmit" class="btn btn-primary">Submit</button>
          </div>
        </form>
        @else

         
            @foreach ($resimler as $resim)
           
            <div style="z-index: 999; float: left" class="col-md-12">
                <img class="showImage" src="{{$path = asset('storage/assets').'/'.$resim->url}}" alt="{{$resim->aciklama}}" alt="">
                 <span class="copyClip">{{$path}}</span>
                 
            </div>
           @endforeach
         
           
       
            
        @endif
        
        
        <div class="box box-primary">
          <div class="box-header">
          <h3 class="box-title">Haber Ekle -> {{$kategori->name}}</h3>
          </div><!-- /.box-header -->
          <div>  
             
         
            
        </div>


        
        <hr>
        <form  action="/admin/haber/addHaber" method="POST"  enctype="multipart/form-data">
          @csrf
        <input type="hidden" name="haberId" value="{{(isset($haber->id))?$haber->id:''}}">
          <div class="box-body">

              {{-- validasyon hataları ekleniyor --}}
              {{-- @include('admin.showErrorsSucces') --}}
             
           
            <div class="form-group">
              <label for="exampleInputPassword1">Açıklaması</label>
            <input name="haberKeywords" value="{{old('haberKeywords')}}" type="text" class="form-control"  placeholder="Anahtar Kelimeleri Giriniz">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Url </label>
                <input value="{{old('haberUrl')}}" name="haberUrl" type="text" class="form-control"  placeholder="url">
              </div>

              <div class="form-group">
                  <label for="exampleInputPassword1">Kısa Açıklama </label>
                  <input value="{{old('haberAciklamasi')}}" name="haberAciklamasi" type="text" class="form-control"  placeholder="Haber Açıklaması">
                </div>

             
                <div class="form-group">
                  <label for="exampleInputFile">Haberin Ana resmini giriniz</label>
                  <input value="{{old('dersResim')}}" name="haberAnaResim" type="file" id="exampleInputFile">
                  <p class="help-block">Resim Seç</p>
                </div>
                

                  <div class="form-group">
                    <label for="exampleInputPassword1">Haber Detayı </label>
                   <textarea name="haberIcerik" class="ckeditor" ></textarea>
                   
                  </div>
           
          
          </div><!-- /.box-body -->
    
          <div class="box-footer">
            <button type="submit" value="submit" name="haberIcerikSubmit" {{isset($haber)?'':'disabled'}} class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div><!-- /.box -->

</div>






    
@endsection

@section('js')
{{-- ck editor  --}}
<script src="/admin/plugins/ckeditor/ckeditor.js"></script>


<script>
    $(function(){
     
      $('.copyClip').click(function(e) {
        var copyText=$(this);
            copyText.select();

  
          document.execCommand("copy");
          alert("Copied the text: " + copyText.value);
      });



    })
   function copy(){
    
    var copyText = document.getElementById("myInput");

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text field */
    document.execCommand("copy");
    
   }
   
   </script>




    
@endsection