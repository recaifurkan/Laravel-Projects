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
                     Kategori Haberleri : {{$kategori->name}}
                    
                  </h1>
            </div>
            <div class="col-md-4">
            <h1><a class="btn btn-success align-middle" href="/admin/haber/addHaber/{{$kategori->id}}">Haber Ekle</a></h1>
              
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
                  
                    <th>Başlık</th>
                    
                    <th>Anahtar Kelimeler</th>
                    <th>Eklenme Tarihi</th>
                    <th>Hit</th>
                    <th>Kısa Açıklama</th>
                    <th>url</th>
                    <th>Kategorisi</th>
                    <th>Yazar</th>
                    <th>İşlemler</th>
                    
                  </tr>
                </thead>
                <tbody>

                  @foreach ($haberler as $haber)
                      
                 
                  <tr>
                   
                    <td>{{$haber->baslik}}</td>
                   
                    <td>{{$haber->keywords}}</td>
                    <td>{{$haber->eklenme_tarihi}}</td>
                    <td>{{$haber->hit}}</td>
                    <td>{{$haber->kisa_aciklama}}</td>
                    <td>{{$haber->url}}</td>
                    <td>{{$haber->kategori->name}}</td>
                    <td>{{isset($haber->user->name)? $haber->user->name : ''}}</th>
                    <td><a class="btn btn-info" href="/admin/haber/editHaber/{{$haber->id}}">Düzenle</a>
                      
                      <form action="/admin/haber/deleteHaber" method="POST">
                        @csrf
                      <input type="hidden" name="haberId" value="{{$haber->id}}">
                      <input class="btn btn-danger" type="submit" name="deleteHaber" value="Sil">
                      </form>
                      
                    <a href="/admin/haber/yorumlar/{{$haber->id}}" class="btn btn-link" href="">Yorumları Gör</a></td>
                   
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
   


    
