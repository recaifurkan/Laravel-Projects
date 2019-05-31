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

        $resim = $haber->get550x330;

    @endphp

    @if (isset($resim))

        

    

     <h1>kapak Resmi</h1>

    <div style="z-index: 999; float: left" class="col-md-12">

            <img class="showImage" src="{{$path = asset('storage/assets').'/'.$resim->url}}" alt="{{$resim->aciklama}}" alt="">

            <span class="copyClip">{{$path}}</span>

             

        </div>

        @endif

       <hr>



         

            {{-- @foreach ($haber->resimler as $resim)

         

            <div style="z-index: 999; float: left" class="col-md-12">

                <img class="showImage" src="{{$path = asset('storage/assets').'/'.$resim->url}}" alt="{{$resim->aciklama}}" alt="">

                 <span class="copyClip">{{$path}}</span>

                 

            </div>

           @endforeach

           --}}

           

       

            

    

        

        

        <div class="box box-primary">

          <div class="box-header">

          <h3 class="box-title">Haber Düzenle -> {{$haber->getKategori->name}}</h3>

          </div><!-- /.box-header -->

          <div>  

             

         

            

        </div>





        

        <hr>

        <form  action="/admin/haber/editHaber" method="POST"  enctype="multipart/form-data">

          @csrf

        <input type="hidden" name="haberId" value="{{(isset($haber->id))?$haber->id:''}}">

          <div class="box-body">



              {{-- validasyon hataları ekleniyor --}}

              @include('admin.showErrorsSucces')

             

              <div class="form-group">

                    <label for="exampleInputPassword1">Başlık</label>

                  <input name="haberAciklama" value="{{$haber->baslik}}" type="text" class="form-control" >

                  </div>

                  <div class="form-group">

                    <label for="exampleInputEmail1">Haber yayınlanma tarihi</label> 
    
                  <input value="{{$haber->eklenmeTarihi}}"  name="eklenmeTarihi" type="date" class="form-control" placeholder="Yayınlanma tarihi giriniz">
    
                  </div>

            <div class="form-group">

              <label for="exampleInputPassword1">Anahtar Kelimeler</label>

            <input name="haberKeywords" value="{{$haber->anahtarKelimeler}}" type="text" class="form-control" >

            </div>

            <div class="form-group">

                <label for="exampleInputPassword1">Url </label>

                <input value="{{$haber->url}}" name="haberUrl" type="text" class="form-control"  placeholder="url">

              </div>



              <div class="form-group">

                  <label for="exampleInputPassword1">Kısa Açıklama </label>

                  <input value="{{$haber->kisaAciklama}}" name="haberAciklamasi" type="text" class="form-control"  placeholder="Haber Açıklaması">

                </div>



             

                <div class="form-group">

                  <label for="exampleInputFile">Haberin Ana resmini giriniz</label>

                  <input  name="haberAnaResim" type="file" id="exampleInputFile">

                  <p class="help-block">Resim Seç</p>

                </div>

                



                  <div class="form-group">

                    <label for="exampleInputPassword1">Haber Detayı </label>

                  <textarea name="haberIcerik" class="ckeditor" >{{htmlspecialchars_decode($haber->icerik)}}</textarea>

                   

                  </div>

           

          

          </div><!-- /.box-body -->

    

          <div class="box-footer">

            <button type="submit" value="submit" name="haberIcerikSubmit" class="btn btn-primary">Submit</button>

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