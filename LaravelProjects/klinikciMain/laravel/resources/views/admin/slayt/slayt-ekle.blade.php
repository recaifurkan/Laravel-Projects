@extends('/admin.master')



@section('icerik')
<div class="row text-center">
  <div class="col-md-6">

      <div class="box-header">
          <h3 class="box-title">Slayt ekle </h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form  action="/admin/slayt/addSlayt" method="POST" enctype="multipart/form-data">
            @csrf
           
            <div class="box-body">
              
                    @include('admin.showErrorsSucces') {{-- hataları falan  bununla gösteriyoruz --}}
           
               
              <div class="form-group">
                <label for="exampleInputEmail1">Slayt sıra</label>
                <input value="{{old('slaytSira')}}" name="slaytSira" type="number" class="form-control" >
              </div>

              <div class="form-group">
                    <label for="exampleInputEmail1">Slayt link Url</label>
                    <input value="{{old('slaytLinkUrl')}}" name="slaytLinkUrl" type="text" class="form-control" >
                  </div>
              <div class="form-group">
                     
                    <input id="aktifCheckbox"  name="slaytIsAktif" type="checkbox" ><label for="aktifCheckbox">Slayt Aktifliği</label>
                    </div>
                  
             
                <div class="form-group">
                      <label for="exampleInputFile">Slayta eklenecek Resimler <span class="text-muted" >En fazla 2mb olmalı </span></label>
                      <input multiple name="slaytResim" type="file" id="exampleInputFile">
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


