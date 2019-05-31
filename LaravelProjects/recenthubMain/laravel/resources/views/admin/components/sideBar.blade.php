<section class="sidebar">

   
        <!-- Sidebar user panel -->

        <div class="user-panel">

          <div class="pull-left image">

           

          </div>

          <div class="pull-left info">

            <p>{{Auth::user()->name.' '.Auth::user()->soyad }}</p>



            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

          </div>

        </div>

        

        <!-- sidebar menu: : style can be found in sidebar.less -->

        <ul class="sidebar-menu">

          <li class="header">Kontrol Paneli</li>


          <li class="treeview">

          <a href="{{route('haberler')}}">

              <i class="fab fa-forumbee"></i>

              <span>Haber</span>

      

            </a>

          </li> 

          <li>

          <a href="">

              <i class="fas fa-user-secret"></i> <span>Üyeler</span>

              </a>

            </li>

           

        </ul>

      </section>

      <!-- /.sidebar -->