@extends('/admin.master')
@section('css')
    <!-- DATA TABLES -->
    <link href="/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection
@section('icerik')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Konular
        
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
                    <th>İsim</th>
                    <th>Url</th>
                    <th>Anahtar Kelimeler</th>
                    <th>Aktiflik</th>
                    <th>Açılış Tarihi</th>
                    <th>Açıklama</th>
                    <th>Kategorisi</th>
                    <th>Görüntülenme Sayısı</th>
                    <th>Beğenilme Sayısı</th>
                    <th>Konuyu Açan</th>
                    <th>İşlemler</th>
                    
                  </tr>
                </thead>
                <tbody>

                  @foreach ($konular  as $konu )
                      
                
                  <tr>
                    <td>{{$konu->id}}</td>
                    <td>{!!htmlspecialchars_decode(showKarakter($konu->name,10))!!}</td>
                    <td>{{$konu->url}}</td>
                    <td>{{showKarakter($konu->keywords,10)}}</td>
                    <td>{{$konu->isaktif}}</td>
                    <td>{{$konu->acilis_tarihi}}</td>
                    <td>{!!htmlspecialchars_decode(showKarakter($konu->aciklama,10))!!}</td>
                    <td>{{$konu->kategori->name}}</td>
                    <td>{{$konu->goruntulenme_sayisi}}</td>
                    <td>{{$konu->begenilme_sayisi}}</td>
                    <td>{{$konu->user->name}}</th>
                      <td>
                        <form action="/admin/forum/deleteKonu" method="post">
                        @csrf
                        <input type="hidden" name="konuId" value="{{$konu->id}}">
                        <input type="submit" class="btn btn-danger" name="deleteKonu" value="Sil">
                        
                        </form>
                      <a class="btn btn-success" href="/admin/forum/konuMesajlar/{{$konu->id}}">Mesajları Gör</a>
                        </td>
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
    <script src="/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
    
        $(function () {
        
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
   
    @endsection
   


    
