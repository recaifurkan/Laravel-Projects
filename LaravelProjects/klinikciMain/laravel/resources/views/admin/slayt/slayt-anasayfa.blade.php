@extends('/admin.master')

@section('icerik')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-8">
                <h1>
                    Slaytlar
                    
                  </h1>
            </div>
            <div class="col-md-4">
            <h1><a class="btn btn-success align-middle" href="{{route('addSlayt')}}">Slayt Ekle</a></h1>
              
            </div>
    
          </div>
    
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
                    
                   
                    <th>Sıra</th>
                    <th>Aktif</th>
                    <th>Resim</th>
                    <th>işlemler</th>
                 
                  </tr>
                </thead>
                <tbody>
                  @foreach ($slaytlar as $slayt)
                      
                
                  <tr>
                    
                    {{-- <input type="hidden" name="slaytId" value="{{$slayt->id}}"> --}}
                    <td>{{$slayt->sira}} </td>
                    <td>{{$slayt->isaktif}} </td>
                     <td>
                       
                        <img style="width: 100px;height: 50px" src="{{asset('storage/assets').'/'.$slayt->resim->url}}" />
                       
                     </td>
                      <td>
                      <a class="btn btn-info" href="/admin/slayt/editSlayt/{{$slayt->id}}">Düzenle</a>
                        <form action="/admin/slayt/deleteSlayt" method="post">
                        @csrf
                        <input type="hidden" name="slaytId" value="{{$slayt->id}}">
                        <input type="submit" value="Sil" class="btn btn-danger">
                      </form>
                      </td>
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
   


    
