@extends('/admin.master')

@section('icerik')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kullanıcılar
        
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
                    <th>İd</th>
                    <th>Kullanıcı Adı</th>
                    <th>İsim</th>
                    <th>Soyisim</th>
                    <th>Üye e-mail</th>
                   
                   
                    <th>Banlandı</th>
                    <th>Üyelik Seviyesi</th>
                    <th>Sınav Türü</th>
                   
                    <th>İşlemler</th>
                   
                   
                   
                   
                    
                  </tr>
                </thead>
                <tbody>
                    @foreach ($uyeler as $uye)
                      
                  

                  
                  <tr>
                      <form action="/admin/editUye" method="post">
                        @csrf
                  <td><input type="hidden" name="uyeId" value="{{$uye ->id}}"> </td>
                  <td>{{$uye ->kullanici_adi}}</td>
                  <td>{{$uye->name}}</td>
                  <td>{{$uye->soyad}}</td>
                  <td>{{$uye->email}}</td>
                  <td>
                    <select name="banlandi" >
                      <option {{$uye->uye_isbanlandi == 0 ? 'selected':''}} value="0">Banlanmadı</option>
                      <option {{$uye->uye_isbanlandi == 1 ? 'selected':''}} value="1">Banlandı</option>
                    </select>
                  </td>
                  <td><select multiple name="uyeRoller[]">
                    @php
                        $uyeRoller = [];
                        foreach ($uye->roller as $rol ) {
                          array_push($uyeRoller,$rol->id);
                        }
                    @endphp
                    @foreach ($roller as $rol)
                   @if (in_array($rol->id,$uyeRoller))
                   <option selected value="{{$rol->id}}">{{$rol->name}}</option>  
                   @else
                   <option  value="{{$rol->id}}">{{$rol->name}}</option>
                   @endif
                 
                   
                    @endforeach
                
                  </select>
                </td>
                  <td>{{isset($uye->sinav->sinav_tur)?$uye->sinav->sinav_tur:''}}</td>
                    <td>
                      <input class="btn btn-info" type="submit" name="editUye" value="Düzenle">
                   
                    
                    </td>
                  </form>
                  </tr>
               
                  @endforeach
                 
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->

          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
    <div style="margin: auto">
    {{$uyeler->links()}}
    </div>
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
   


    
