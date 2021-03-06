@extends('/admin.master')
@section('css')
    <!-- DATA TABLES -->
    <link href="/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection
@section('icerik')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Forum Kategoriler
        
      </h1> 
    
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <div class="box-body">
              @include('admin/showErrorsSucces')
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>İd</th>
                    <th>İsim</th>
                    <th>Url</th>
                    <th>Üst Kategorisi</th>
                    <th>İşlemler</th>
                    
                  </tr>
                </thead>
               
                    <tbody>
                        <tr>
                            <form action="/admin/forum/addKategori" method="post">
                              @csrf
                              
                          <td></td>
                          <td><input class="form-control" type="text" name="kategoriName" placeholder="Yeni Kategori İsmi" value="{{old('kategoriName')}}"> </td>
                          <td><input class="form-control" type="text" name="kategoriUrl" placeholder="Yeni Kategori Url" value="{{old('kategoriUrl')}}">  </td>
                         
                          
                          <td>
                            <select class="form-control" name="ustKategori" >
                            <option value="0">Üst kategorisi Yok</option>
                            @foreach ($kategoriler as $kategoriSelect)
                      
                        <option value="{{$kategoriSelect->id}}" >
                            {{$kategoriSelect->name}}
                       </option>
                       
                        
                        @endforeach
                            
                          </select>
                        </td> 
                          <td>
                            <input class="btn btn-success" value="Ekle" name="Ekle" type="submit">
                          
                          </td>
                        </form>
                        </tr>
                      @foreach ($kategoriler as $kategori) 
                       
                     <tr>
                        <form action="/admin/forum/editKategori" method="post">
                          @csrf
                          <input type="hidden" name="kategoriId" value="{{$kategori->id}}">
                        <td>{{$kategori->id}}</td>
                      <td><input class="form-control" type="text" name="kategoriName" value="{{$kategori->name}}"> </td>
                      <td><input class="form-control" type="text" name="kategoriUrl" value="{{$kategori->url}}">  </td>
                     
                      
                      <td><select class="form-control" name="ustKategori" >
                        <option value="0">Üst kategorisi Yok</option>
                        @foreach ($kategoriler as $kategoriSelect)
                        @if ($kategori!=$kategoriSelect)
                        <option value="{{$kategoriSelect->id}}"
                          {{-- üst kategorisi var mı diye kontrol edilip varsa onnun seçilmesi sağlandı  --}}
                            {{$kategori->ustkategori ? 
                            (($kategori->ustKategori->id == $kategoriSelect->id) ? 'selected':''):''}} >
                            {{$kategoriSelect->name}}
                       </option>
                        @endif
                        
                        @endforeach
                        
                      
                      </select>
                    </td>
                     
                      <td>
                        <input class="btn btn-info" value="Düzenle" name="submitDuzenle" type="submit">
                        <input class="btn btn-danger" value="Sil" name="submitDelete" type="submit">
                      <a class="alert-secondary " href="/admin/forum/konular/{{$kategori->id}}">Konuları Gör</a>
                      </td>
                    </form>
                    </tr>
                 
                     @endforeach
                    </tbody>
                  
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->

          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
    @endsection

    @section('js')
           <!-- DATA TABES SCRIPT -->
           <script src="/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
           <script src="/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
          $("#example1").dataTable();
          $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
          });
        });
      </script>
   
    @endsection
   


    
