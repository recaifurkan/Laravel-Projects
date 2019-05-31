@extends('/admin.master')



@section('icerik')
<div class="row text-center">
  <div class="col-md-6">

      <div class="box-header">
          <h3 class="box-title">Spot : {{$spot->icerik}}</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form  action="/admin/spot/editSpot" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$spot->id}}" name="spotId">
            <div class="box-body">
              
               {{-- validasyon hataları ekleniyor --}}
              @php
              if(session()->get('hatalar')){
               $hatalar = session()->get('hatalar');
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
              @php
              if(session()->get('succes')){
               $succes = session()->get('succes');
              }
                  
              @endphp
             
              @if(isset($succes))
             
              <div class="alert-success" >
                  {{$succes}}
               </div>
             
             
                @endif
           
               
              <div class="form-group">
                <label for="exampleInputEmail1">Spot</label>
                <input value="{!! htmlspecialchars_decode($spot->icerik)!!}" id="spotIcerik" name="spotIcerik" type="text" class="form-control" placeholder="İçerik yazınız">
              </div>
              <div class="form-group">
                      <label for="exampleInputPassword1">Url</label>
                    <input value="{!! htmlspecialchars_decode($spot->url)!!}" name="spotUrl" type="text" id="spotUrl" class="form-control"  placeholder="Url">
                    </div>
                    <div class="form-group">
                          <label for="exampleInputPassword1">Anahtar Kelime Griniz <span class="text-muted">',' ile ayırınız</span></label>
                        <input value="{!! htmlspecialchars_decode($spot->keywords)!!}" name="spotKeywords" id="spotKeywords" type="text" class="form-control"  placeholder="Anahtar kelime giriniz">
                        </div>
             
             
             
                <div class="form-group">
                      <label for="exampleInputFile">Spot eklenecek Resimler <span class="text-muted" >En fazla 2mb olmalı </span></label>
                      <input multiple name="spotResim[]" type="file" id="exampleInputFile">
                      <p class="help-block">Resim Seç</p>
                    </div>
             
            
            </div><!-- /.box-body -->
      
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
  </div>




  <div class="col-md-6"></div>
  <div>
      <h1>Spot Resimleri</h1>
        @foreach ($spot->resimler as $resim )
          <img style="width: 100px;height: 100px;" src="{{asset('storage/assets').'/'.$resim->url}}">
         @endforeach


    </div>

</div>

  
   
       
               
            
             
         
     
   
   
  









    
@endsection

@section('js')
    <script>


         $('#spotIcerik').on('input',function(e){
              var girilenYazi = $(this).val();
            
              var spotKeywords = $('#spotKeywords');
              
              spotKeywords.val(replaceAll(girilenYazi,' ',',').toLowerCase());

               
         });

        /**
 * Metni url'de kullanılabilir hale çevirir. Boşluklar tireye çevrilir, 
 * alfanumerik olmayan katakterler silinir.
 * 
 * Transform text into a URL path slug(with Turkish support). 
 * Spaces turned into dashes, remove non alnum
 * 
 * @param string text
 */
slugify = function(text) {
    var trMap = {
        'çÇ':'c',
        'ğĞ':'g',
        'şŞ':'s',
        'üÜ':'u',
        'ıİ':'i',
        'öÖ':'o'
    };
    for(var key in trMap) {
        text = text.replace(new RegExp('['+key+']','g'), trMap[key]);
    }
    return  text.replace(/[^-a-zA-Z0-9\s]+/ig, '') // remove non-alphanumeric chars
                .replace(/\s/gi, "-") // convert spaces to dashes
                .replace(/[-]+/gi, "-") // trim repeated dashes
                .toLowerCase();

}

replaceAll =  function(string, target, replacement) {
 
 var i = 0, length = string.length;
 
 for (i; i < length; i++) {
 
   string = string.replace(target, replacement);
 
 }
 
 return string;
 
}
    
    
    
    
    
    </script>
@endsection