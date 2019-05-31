@extends('/admin.master')
@section('css')
    <!-- DATA TABLES -->
    <link href="/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection
@section('icerik')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <section class="content-header">
            <div class="row">
              <div class="col-md-8">
                  <h1>
                      Kategori Dersleri : {{$kategori->name}}
                      
                    </h1>
              </div>
              <div class="col-md-4">
              <h1><a class="btn btn-success align-middle" href="/admin/spot/addDers/{{$kategori->id}}">Ders Ekle</a></h1>
                
              </div>
      
            </div>
           
          
          </section>
      <h1>
      
        
      </h1>
    
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
                    <th>Açıklama</th>
                    <th>Url</th>
                    <th>Kategorisi</th>
                    <th>İşlemler</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dersler as $ders)
                      
                 
                  <tr>
                      <td>{{$ders->id}}</td>
                      <td>{{$ders->name}}</td>
                      <td>{{$ders->aciklama}}</td>
                      <td>{{$ders->url}}</td>
                      <td>{{$ders->kategori->name}}</td>
                      <td>
                          <a class="btn btn-info" href="/admin/spot/editDers/{{$ders->id}}">Düzenle</a>
                          <form method="POST" action="/admin/spot/deleteDers">
                            @csrf
                            <input type="hidden" name="dersId" value="{{$ders->id}}">
                            <input class="btn btn-danger" type="submit" value="Sil">
                        
                        </form>
                          <a class="btn btn-warning" href="{{route('admin-spot-uniteler',['dersId'=>$ders->id])}}">Üniteleri Gör</a>
                       
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
   


    
