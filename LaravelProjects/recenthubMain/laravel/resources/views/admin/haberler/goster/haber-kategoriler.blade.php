@extends('/admin.master')

@section('css')

    <!-- DATA TABLES -->

    <link href="/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

@endsection

@section('icerik')



    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Haberler

        

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

                   

                    <th>İsim</th>

                   

                    <th>Açıklama</th>

                    <th>Kategorisi</th>

                    <th>İşlemler</th>

                    

                  </tr>

                </thead>

                <tbody>

                    <tr>

                        <form action="/admin/addKategori" method="post">

                          @csrf

                          

                     

                      <td><input class="form-control" type="text" name="kategoriName" placeholder="Yeni Kategori İsmi" value="{{old('kategoriName')}}"> </td>

                      

                      <td><input class="form-control" type="text" name="kategoriAciklama" placeholder="Yeni Kategori Açıklaması" value="{{old('kategoriAciklama')}}"> </td>

                      

                      <td><select class="form-control" name="ustKategori" >

                        <option value="0">Üst kategorisi Yok</option>

                        @foreach ($kategoriler as $kategoriSelect)

                      

                        <option value="{{$kategoriSelect->id}}">{{$kategoriSelect->name}} </option>

                      

                        

                        @endforeach

                        

                      </select>

                    </td>

                      <td>

                        <input class="btn btn-success" value="Ekle" name="Ekle" type="submit">

                      

                      </td>

                    </form>

                    </tr>

                  @foreach ($kategoriler as $kategori) 

                   

                 <tr>

                    <form action="/admin/editKategori" method="post">

                      @csrf

                      <input type="hidden" name="kategoriId" value="{{$kategori->id}}">

                 

                  <td><input class="form-control" type="text" name="kategoriName" value="{{$kategori->name}}"> </td>

                  

                  <td><input class="form-control" type="text" name="kategoriAciklama" value="{{$kategori->aciklama}}"> </td>

                  

                  <td><select class="form-control" name="ustKategori" >

                    <option value="0">Üst kategorisi Yok</option>

                    @foreach ($kategoriler as $kategoriSelect)

                    @if ($kategori!=$kategoriSelect)

                    <option value="{{$kategoriSelect->id}}"

                      {{-- üst kategorisi var mı diye kontrol edilip varsa onnun seçilmesi sağlandı  --}}

                        {{$kategori->getUstkategori ? 

                        (($kategori->getUstKategori->id == $kategoriSelect->id) ? 'selected':''):''}} >

                        {{$kategoriSelect->name}}

                   </option>

                    @endif

                    

                    @endforeach

                    

                  

                  </select>

                </td>

                 

                  <td>

                    <input class="btn btn-info" value="Düzenle" name="submitDuzenle" type="submit">

                    <input class="btn btn-danger" value="Sil" name="submitDelete" type="submit">

                  <a class="alert-secondary " href="/admin/haberler/{{$kategori->id}}">Haberleri Gör</a>

                  </td>

                </form>

                </tr>

             

                 @endforeach

                </tbody>

                 

                 

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

   





    

