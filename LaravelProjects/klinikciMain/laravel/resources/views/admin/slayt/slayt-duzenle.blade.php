@extends('/admin.master')



@section('icerik')
<div style="margin: auto" class="text-center container col-md-7">
    <div class="box box-primary">
        <div class="box-header">
        <h3 class="box-title">Slayt Düzenle </h3>
        </div><!-- /.box-header -->
        <div>  
           
       @if (isset($slayt->resim))
       <img width="100px" height="100px" class="card-img-bottom spotAnasayfa" src="{{asset('storage/assets').'/'.$slayt->resim->url}}" alt="{{$slayt->resim->aciklama}}">
       @endif
          
      </div>
        <!-- form start -->
        <form  action="/admin/slayt/editSlayt" method="POST"  enctype="multipart/form-data">
          @csrf
            <input type="hidden" value="{{$slayt->id}}" name="slaytId">
          <div class="box-body">

              {{-- validasyon hataları ekleniyor --}}
              @include('/admin.showErrorsSucces')
             
              <div class="form-group">
                  <label for="exampleInputEmail1">Slayt sıra</label>
                  <input value="{{$slayt->sira}}" name="slaytSira" type="number" class="form-control" >
                </div>

                <div class="form-group">
                        <label for="exampleInputEmail1">Slayt link Url</label>
                        <input value="{{$slayt->linkUrl}}" name="slaytLinkUrl" type="text" class="form-control" >
                      </div>
                <div class="form-group">
                       
                <input id="aktifCheckbox"  name="slaytIsAktif" type="checkbox" {{$slayt->isaktif==1?'checked':''}}  ><label for="aktifCheckbox">Slayt Aktifliği</label>
                      </div>
                    
               
                  <div class="form-group">
                        <label for="exampleInputFile">Slayta eklenecek Resim <span class="text-muted" >En fazla 2mb olmalı </span></label>
                        <input multiple name="slaytResim" type="file" id="exampleInputFile">
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