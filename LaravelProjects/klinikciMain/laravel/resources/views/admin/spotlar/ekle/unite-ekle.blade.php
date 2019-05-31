@extends('/admin.master')



@section('icerik')
<div style="margin: auto" class="text-center container col-md-7">
    <div class="box box-primary">
        <div class="box-header">
        <h3 class="box-title">Ünite Ekle -> {{$ders->name}}</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/spot/addUnite" method="post" >
          @csrf
            <input type="hidden" value="{{$ders->id}}" name="dersId">
          <div class="box-body">

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
              <label for="exampleInputEmail1">Ünite ismi</label>
              <input value="{{old('uniteIsim')}}" name="uniteIsim" type="text" class="form-control" placeholder="İsim Giriniz">
            </div>
            <div class="form-group">
                    <label for="exampleInputPassword1">Açıklama</label>
                  <input value="{{old('uniteAciklama')}}" name="uniteAciklama" type="text" class="form-control"  placeholder="Açıklama">
                  </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Url</label>
            <input value="{{old('uniteUrl')}}" name="uniteUrl" type="text" class="form-control"  placeholder="Url">
            </div>
           
          
          </div><!-- /.box-body -->
    
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div><!-- /.box -->

</div>






    
@endsection