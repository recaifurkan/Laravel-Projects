@extends('/admin.master')

@section('icerik')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sınavlar
        
      </h1>
    
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <div class="box-body">
              @include('admin.showErrorsSucces')
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    {{-- <th>İd</th> --}}
                    <th>Sınav Türü</th>
                    <th>Sınav Tarihi</th>
                    <th>İşlemler</th>
                   
                    
                  </tr>
                </thead>
                <tbody>
                 
                    @foreach ($sinavlar as $sinav)
                    <tr>
                    <form action="/admin/sinav/editSinav" method="POST">
                      @csrf
                      <input type="hidden" name="sinavId" value="{{$sinav->id}}">
                    
                    <td>{{$sinav->sinav_tur}}</td>
                    <td><input type="date" name="sinavTarih" value="{{date('Y-m-d', strtotime($sinav->sinav_tarih))}}"></td>
                    <td><input class="btn btn-info" value="Düzenle" type="submit"></td>
                  </form>
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
   


    
