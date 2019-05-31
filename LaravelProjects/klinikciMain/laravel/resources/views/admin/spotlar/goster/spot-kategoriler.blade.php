@extends('/admin.master')
@section('css')
    <!-- DATA TABLES -->
    <link href="/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection
@section('icerik')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-md-8">
            <h1>
                Spot : Kategoriler
                
              </h1>
        </div>
        <div class="col-md-4">
          <h1><a class="btn btn-success align-middle" href="/admin/spot/addKategori">Kategori Ekle</a></h1>
          
        </div>

      </div>
     
    
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <div class="box-body">
                @include('admin.showErrorsSucces') {{-- hataları falan  bununla gösteriyoruz --}}
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>İd</th>
                    <th>İsim</th>
                    <th>url</th>
                    <th>Anahtar Kelimeler</th>
                    <th>işlemler</th>
                    
                  </tr>
                </thead>
                <tbody>
 
                  @foreach ($kategoriler as $kategori)
                  <tr>
                    <td>{{$kategori->id}}</td>
                  <td>{{$kategori->name}}</td>
                    <td>{{$kategori->url}}</td>
                    <td>{{$kategori->keywords}}</td>
                    <td>
                      <a class="btn btn-info" href="/admin/spot/editKategori/{{$kategori->id}}">Düzenle</a>
                      <form method="POST" action="/admin/spot/deleteKategori">
                        @csrf
                        <input type="hidden" name="kategoriId" value="{{$kategori->id}}">
                        <input class="btn btn-danger" type="submit" value="Sil">
                    
                    </form>
                      <a class="btn btn-warning" href="{{route('admin-spot-dersler',['kategoriId'=>$kategori->id])}}">Dersleri Gör</a>
                    </td>  
                    </tr>
                  @endforeach
                 
                 
                </tfoot>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->

          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
    @endsection

    @section('js')
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
          <!-- DATA TABES SCRIPT -->
    <script src="/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    @endsection
   


    
