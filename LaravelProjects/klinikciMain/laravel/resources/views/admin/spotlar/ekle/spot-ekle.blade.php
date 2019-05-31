@extends('/admin.master')



@section('icerik')
<div class="row text-center">
  <div class="col-md-6">

      <div class="box-header">
          <h3 class="box-title">Spot ekle -> {{$unite->name}}</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form  action="/admin/spot/addSpot" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$unite->id}}" name="uniteId">
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
                <label for="exampleInputEmail1">Spot</label>
                <input value="{{old('spotIcerik')}}" id="spotIcerik" name="spotIcerik" type="text" class="form-control" placeholder="İçerik yazınız">
                <button id="asagiOk" class="btn btn-primary">aşağı ok ekle </button>
                <button id="satir" class="btn btn-primary">satır ekle </button>
               
               
              </div>
              <div class="form-group">
                      <label for="exampleInputPassword1">Url</label>
                    <input value="{{old('spotUrl')}}" name="spotUrl" id="spotUrl" type="text" class="form-control"  placeholder="Url">
                    </div>
                    <div class="form-group">
                          <label for="exampleInputPassword1">Anahtar Kelime Griniz <span class="text-muted">',' ile ayırınız</span></label>
                        <input value="{{old('spotKeywords')}}" name="spotKeywords" id="spotKeywords" type="text" class="form-control"  placeholder="Anahtar Kelimeler">
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
 

</div>

  
   
       
               
            
             
         
     
   
   
  









    
@endsection
@section('js')
<script>
        $(function(){
            $('#asagiOk').click(function(e){
                e.preventDefault();
                var icerik =  $('#spotIcerik');
                var yazi = icerik.val();
                yazi += "<br>↓<br>";
                icerik.val(yazi);
                icerik.focus(); 
            });

            $('#satir').click(function(e){
                e.preventDefault();
                var icerik =  $('#spotIcerik');
                var yazi = icerik.val();
                yazi += "<br>";
                icerik.val(yazi);
                icerik.focus();
            });


        });
   
    
    </script>
    <script>


         $('#spotIcerik').on('input',function(e){
              var girilenYazi = $(this).val();
              var spotUrl = $('#spotUrl');
              var spotKeywords = $('#spotKeywords');
              spotUrl.val(slugify(girilenYazi));
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

decription = function(text) {
   
    return  text.replace(/[^-a-zA-Z0-9\s]+/ig, '') // remove non-alphanumeric chars
               
              

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