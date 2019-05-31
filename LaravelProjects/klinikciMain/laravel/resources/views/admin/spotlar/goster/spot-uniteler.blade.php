@extends('/admin.master')
@section('css')
    <!-- DATA TABLES -->
    <link href="../../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection
@section('icerik')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-8">
                <h1>
                    Ders Uniteleri : {{$ders->name}}
                    
                  </h1>
            </div>
            <div class="col-md-4">
            <h1><a class="btn btn-success align-middle" href="/admin/spot/addUnite/{{$ders->id}}">Ünite Ekle</a></h1>
              
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
                    <th>Açıklama</th>
                    <th>Eklenme Tarihi</th>
                    <th>Url</th>
                    <th>Dersi</th>
                    <th>işlemler</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($uniteler as $unite)
                      
                 
                  <tr>
                      <th>{{$unite->id}}</td>
                      <td>{{$unite->name}}</td>
                      <td>{{$unite->aciklama}}</td>
                      <td>{{$unite->eklenme_tarihi}}</td>
                      <td>{{$unite->url}}</td>
                      <td>{{$unite->ders->name}}</td>
                      <td>
                          <a class="btn btn-info" href="/admin/spot/editUnite/{{$unite->id}}">Düzenle</a>
                          <form method="POST" action="/admin/spot/deleteUnite">
                            @csrf
                            <input type="hidden" name="uniteId" value="{{$unite->id}}">
                            <input class="btn btn-danger" type="submit" value="Sil">
                        
                        </form>
                          <a class="btn btn-warning" href="{{route('admin-spot-spotlar',['spotId'=>$unite->id])}}">Spotları Gör</a>
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
   


    
