@extends('/admin.master')
@section('css')
    <!-- DATA TABLES -->
    <link href="/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection
@section('icerik')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Slaytlar
        
      </h1>
    
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>İd</th>
                    <th>İçerik</th>
                    <th>Haberi</th>
                    
                    <th>Yorum Tarihi</th>
                  
                    <th>Beğeni</th>
                    <th>Üst Yorumu</th>
                    <th>Kullanıcı</th>
                   
                    <th>İşlemler</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($yorumlar as $yorum)
                      
                  
                  <tr>
                      <td>{{$yorum->id}}</td>
                      <td>{!!htmlspecialchars_decode($yorum->icerik)!!}</td>
                      <td>{{$yorum->haber->baslik}}</td>
                      
                      <td>{{$yorum->yorum_tarihi}}</td>
                      <td>{{$yorum->like}}</td>
                      @if(isset($yorum->ust_yorum_id))
                      <td>{{$yorum->ust_yorum_id}}</td>
                      @else
                      <td></td>
                      @endif
                     
                      <td>{{$yorum->user->name}}</td>
                   
                    <td><a href="">Düzenle</a><a href="">Sil</a></td>
                   
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
   


    
