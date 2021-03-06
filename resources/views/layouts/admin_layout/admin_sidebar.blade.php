



<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link">
      <img src="{{asset('images/hudumalogo.png') }}" alt="Huduma Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ucwords(Auth::guard('admin')->user()->name)}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               @if (Session::get('page') =="dashboard")
               <?php $active ='active' ?>
               @else
               <?php $active ='' ?>
            @endif

               <li class="nav-item">
                <a href="{{url('/admin/dashboard')}}" class="nav-link {{$active}}">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>

                          <!--Settings -->
              @if (Session::get('page') =="settings" || Session::get('page')=="update-admin-details")
              <?php $active ='active' ?>
              @else
              <?php $active ='' ?>
           @endif
          <li class="nav-item has-treeview menu-open">

            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (Session::get('page') =="settings")
              <?php $active ='active' ?>
              @else
              <?php $active ='' ?>
           @endif
              <li class="nav-item">
                <a href="{{url('admin/settings')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Password</p>
                </a>
              </li>
              @if (Session::get('page') =="update-admin-details")
              <?php $active ='active' ?>
              @else
              <?php $active ='' ?>
           @endif
              <li class="nav-item">
                <a href="{{url('admin/update-admin-details')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Details</p>
                </a>
              </li>

            </ul>
          </li>

                        <!--Operations -->
                        @if (Session::get('page') =="Centres" || Session::get('page')=="services"|| Session::get('page')=="agencies")
                        <?php $active ='active' ?>
                        @else
                        <?php $active ='' ?>
                     @endif
                    <li class="nav-item has-treeview menu-open">

                      <a href="#" class="nav-link {{$active}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                          Operations
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        @if (Session::get('page') =="Centres")
                        <?php $active ='active' ?>
                        @else
                        <?php $active ='' ?>
                      @endif
                       <!--Centers -->
                    <li class="nav-item">
                      <a href="{{route('admin.centres.index')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Centers</p>
                      </a>
                    </li>
                        <!--Services -->

                        @if (Session::get('page') =="services")
                        <?php $active ='active' ?>
                        @else
                        <?php $active ='' ?>
                      @endif
                    <li class="nav-item">
                      <a href="{{route('admin.services.index')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Services</p>
                      </a>
                    </li>
   <!--Agencies -->

                  @if (Session::get('page') =="agencies")
                  <?php $active ='active' ?>
                  @else
                  <?php $active ='' ?>
                @endif
                <li class="nav-item">
                <a href="{{route('admin.mdas.index')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agencies</p>
                </a>
                </li>

                      </ul>
                    </li>

                  <!--uploads -->

            @if (Session::get('page') =="uploads")
            <?php $active ='active' ?>
            @else
            <?php $active ='' ?>
          @endif
            <li class="nav-item">
                <a href="{{ route('institutions.index') }}" class="nav-link"> <i class="nav-icon fa fa-building"></i>Institutions</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('servicecharter.index') }}" class="nav-link"> <i class="nav-icon fa fa-book"></i>Service Charters</a>
            </li>
        <li class="nav-item">
          <a href="{{route('admin.uploads.create')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-th"></i>
            <p>Upload</p>
          </a>
        </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
