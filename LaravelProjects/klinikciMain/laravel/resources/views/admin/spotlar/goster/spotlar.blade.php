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
                    Unite Spotları : {{$unite->name}}
                    
                  </h1>
            </div>
            <div class="col-md-4">
            <h1><a class="btn btn-success align-middle" href="/admin/spot/addSpot/{{$unite->id}}">Spot Ekle</a></h1>
              
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
                    <th>İçerik</th>
                    <th>Url</th>
                    <th>Anahtar Kelimeler</th>
                    <th>Beğeni Sayısı</th>
                    <th>Eklenme Tarihi</th>
                    <th>Hit</th>
                    <th>Ünitesi</th>
                    <th>Yazar</th>
                    <th>işlemler</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($spotlar as $spot)
                  <tr>
                      <td>{{$spot->id}}</td>
                      <td>{!! htmlspecialchars_decode(showKarakter($spot->icerik,20))!!}</td>
                      <td>{{showKarakter($spot->url,25)}}</td>
                      <td>{{showKarakter($spot->keywords,25)}}</td>
                      <td>{{$spot->like}}</td>
                      <td>{{$spot->eklenme_tarihi}}</td>
                      <td>{{$spot->hit}}</td>
                      <td>{{$spot->unite->name}}</td>
                      @if ($spot->user)
                      <td>{{$spot->user->name}}</td>
                      @else
                       <td></td>   
                      @endif
                     
                      <td>
                          <a class="btn btn-info" href="/admin/spot/editSpot/{{$spot->id}}">Düzenle</a>
                          <form method="POST" action="/admin/spot/deleteSpot">
                            @csrf
                            <input type="hidden" name="spotId" value="{{$spot->id}}">
                            <input class="btn btn-danger" type="submit" value="Sil">
                        
                        </form>
                          <a class="btn btn-warning" href="{{route('admin-spot-yorumlar',['spotId'=>$spot->id])}}">Yorumları Gör</a>
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
   


    
