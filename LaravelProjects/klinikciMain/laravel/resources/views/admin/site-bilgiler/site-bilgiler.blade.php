@extends('/admin.master')

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
                    <th>Sıra</th>
                    <th>Site İsmi</th>
                    <th>Site Anahtar Kelimeler</th>
                    <th>Site Açıklama</th>
                    <th>Site Yazar</th>
                    <th>Site Facebook</th>
                    <th>Site Twitter</th>
                    <th>Site İnstagram</th>
                    <th>Site gmail</th>
                    <th>Site Kısaca Bilgi</th>
                    <th>Aktif</th>
                    <th>işlemler</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 4.0</td>
                    <td>Win 95+</td>
                    <td><a href="">Düzenle</a><a href="">Sil</a></td>
                   
                  </tr>
                 
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
   


    
