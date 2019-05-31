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
                @include('admin.showErrorsSucces') {{-- hataları falan  bununla gösteriyoruz --}}
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>İd</th>
                    <th>İçerik</th>
                    <th>Eklenme Tarihi</th>
                     <th>Beğeni Sayısı</th>
                     <th>Üst Yorum</th>
                     <th>Spotu</th>
                     <th>Yazar</th>
                    <th>işlemler</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($yorumlar as $yorum)
                      
                
                  <tr>
                      <td>{{$yorum->id}}</td>
                      <td>{!!htmlspecialchars_decode($yorum->icerik)!!}</td>
                      <td>{{$yorum->eklenme_tarih}}</td>
                       <td>{{$yorum->like}}</td>
                       
                       @if (isset($yorum->ustYorum))
                       <td>{{$yorum->ustYorum->id}}</td>
                       @else
                       <td></td>  
                       @endif

                       @if (isset($yorum->spot))
                       <td>{{$yorum->spot->id}}</td>
                       @else
                       <td></td>  
                       @endif
                      
                       <td>{{$yorum->user->name}}</td>
                    <td>
                    <form method="POST" action="/admin/spot/deleteYorum">
                        @csrf
                        <input type="hidden" name="yorumId" value="{{$yorum->id}}">
                        <input class="btn btn-danger" type="submit" value="Sil">
                    
                    </form></td>
                   
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
   


    
