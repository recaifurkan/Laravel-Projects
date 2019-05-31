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
              @include('admin/showErrorsSucces')
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>İd</th>
                    <th>İcerik</th>
                    <th>Beğeni</th>
                    <th>Mesaj onay</th>
                    <th>Yazılma Tarihi</th>
                    <th>Konu id</th>
                    <th>Konusu</th>
                    <th>İşlemler</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($mesajlar as $mesaj)
                      
               
                  <tr>
                      <td>{{$mesaj->id}}</td>
                      <td>{!!htmlspecialchars_decode($mesaj->icerik)!!}</td>
                      <td>{{$mesaj->begeni}}</td>
                      <td>{{$mesaj->mesaj_onay}}</td>
                      <td>{{$mesaj->yazilma_tarihi}}</td>
                    @if (isset($mesaj->konu))
                    <td>{{$mesaj->konu->id}}</td>
                    @else
                    <td></td>    
                    @endif
                    <td>{{$mesaj->user->name}}</td>
                    <td>
                      <form action="/admin/forum/deleteMessage" method="POST">
                      @csrf
                      <input type="hidden" name="mesajId" value="{{$mesaj->id}}">
                      <input type="submit" class="btn btn-danger" name="delete" value="Sil">
                    
                    </form>
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
   


    
