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

        




     

        

        

        <div class="box box-primary">

          <div class="box-header">
                <form  action="/admin/addHaber" method="POST"  enctype="multipart/form-data">
          <h3 class="box-title">Haber Ekle <br> ↓ </h3>
          <select class="form-control" name="kategoriId" >

                {{-- <option value="0">Üst kategorisi Yok</option> --}}

                @foreach ($kategoriler as $kategoriSelect)

                <option value="{{$kategoriSelect->id}}"

                  {{-- üst kategorisi var mı diye kontrol edilip varsa onnun seçilmesi sağlandı  --}}

                   

                   {{(($kategori->id == $kategoriSelect->id) ? 'selected':'')}}  >

                    {{$kategoriSelect->name}}

               </option>

               

                

                @endforeach

                

              

              </select>

          </div><!-- /.box-header -->


        

          @csrf

        

          <div class="box-body">


              {{-- validasyon hataları ekleniyor --}}

              @include('admin.showErrorsSucces')

              <div class="form-group">

                <label for="exampleInputFile">Habere resim giriniz</label>

                <input value="{{old('dersResim')}}" name="haberAnaResim" type="file" id="exampleInputFile">

                <p class="help-block">Resim Seç</p>

              </div>

              <div class="form-group">

                <label for="exampleInputEmail1">Haber Başlığı</label>

              <input value="{{old('haberBaslik')}}"  name="haberBaslik" type="text" class="form-control" placeholder="Başlık Giriniz">

              </div>

              <div class="form-group">

                <label for="exampleInputEmail1">Haber yayınlanma tarihi</label>
                @php
                    $enSonEklenmeTarihi = '';
                   
                    $eklenmeAdet = 0;
                    foreach ($haberler as $haber ) {
                        if($haber->eklenmeTarihi > $enSonEklenmeTarihi){
                            $eklenmeAdet = 0;
                            $enSonEklenmeTarihi = $haber->eklenmeTarihi;

                        }
                        if($haber->eklenmeTarihi == $enSonEklenmeTarihi){
                            $eklenmeAdet +=1;
                        }  
                    }
                    $enSonEklenmeTarihi = new DateTime($enSonEklenmeTarihi);
                    if($eklenmeAdet >= 5){
                        $yeniGün = $enSonEklenmeTarihi->modify('+1 day');
                        $yeniGün = $enSonEklenmeTarihi->format('Y-m-d');
                    }   
                    else{
                        $enSonEklenmeTarihi = $enSonEklenmeTarihi->format('Y-m-d');
                    }
                    
                @endphp

              <input value="{{isset($yeniGün)?$yeniGün:$enSonEklenmeTarihi}}"  name="eklenmeTarihi" type="date" class="form-control" placeholder="Yayınlanma tarihi giriniz">
                    <div>
                         {{isset($yeniGün)?'Önceki gün haber sınırını doldurduğundan yeni güne geçildi'
                         :
                         'Bu günde '. $eklenmeAdet. ' adet haber bulunmakta'
                         }} 
                    </div>
              </div>
              {{-- <div>
                {{$enSonEklenmeTarihi->format('Y-m-d')}}
              </div> --}}

             


              <div class="form-group">

                  <label for="exampleInputPassword1">Kısa Açıklama </label>

                  <input value="{{old('haberAciklamasi')}}" name="haberAciklamasi" type="text" class="form-control"  placeholder="Haber Açıklaması">

                </div>



             

                

                



                  <div class="form-group">

                    <label for="exampleInputPassword1">Haber Detayı </label>

                   <textarea name="haberIcerik" class="ckeditor" ></textarea>

                   

                  </div>

           

          

          </div><!-- /.box-body -->

    

          <div class="box-footer">

            <button type="submit" class="btn btn-primary">Submit</button>

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