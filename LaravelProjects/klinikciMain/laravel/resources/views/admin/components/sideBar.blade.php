<section class="sidebar">
    @php
    $roller = [];
        foreach (Auth::user()->roller as $rol ) {
            array_push($roller,$rol->name);
        }
    @endphp
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{route('profilResim',['uyeId'=>Auth::user()->id])}}" class="img-circle" alt="{{isset(Auth::user()->name) ? Auth::user()->name: Auth::user()->kullanici_adi }}" />
          </div>
          <div class="pull-left info">
            <p>{{Auth::user()->name.' '.Auth::user()->soyad }}</p>

            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">Kontrol Paneli</li>
        
         {{-- @if (in_array('Super Admin',$roller) || in_array('Haber Editörü',$roller))
         <li class="treeview">
                <a href="/admin/haber/kategoriler">
                  <i class="fas fa-newspaper"></i>
                  <span>Haberler</span>
              
                </a>
               
              </li> 
         @endif --}}
         @if (in_array('Super Admin',$roller) || in_array('Spot Editörü',$roller))
          <li class="treeview">
          <a href="{{route('admin-spot-kategoriler')}}">
              <i class="fab fa-empire"></i>
            
              <span>Spotlar</span>
            
            </a>
           
          </li> 
          @endif
          @if (in_array('Super Admin',$roller) || in_array('Forum Editörü',$roller))
          <li class="treeview">
            <a href="/admin/forum/kategoriler">
              <i class="fab fa-forumbee"></i>
              <span>Forum</span>
      
            </a>
            
          </li> 
          @endif

          @if (in_array('Super Admin',$roller) || in_array('Haber Editörü',$roller))
          <li class="treeview">
            <a href="/admin/haber/kategoriler">
              <i class="fab fa-forumbee"></i>
              <span>Haber</span>
      
            </a>
            
          </li> 
          @endif
          @if (in_array('Super Admin',$roller))

          <li class="treeview">
          <a href="{{route('sinavlar')}}">
              <i class="fas fa-graduation-cap"></i>
              <span>Sınavlar</span>
          
            </a>
            
          </li> 
          @endif
          @if (in_array('Super Admin',$roller))
          <li>
          <a href="{{route('slaytlar')}}">
                <i class="fa fa-th"></i> <span>Slaytlar</span>
              </a>
            </li>
            @endif

            @if (in_array('Super Admin',$roller))
          <li>
          <a href="{{route('uyeler')}}">
              <i class="fas fa-user-secret"></i> <span>Üyeler</span>
              </a>
            </li>
            @endif
                      
                     
         
          
          
         
          
         
        </ul>
      </section>
      <!-- /.sidebar -->