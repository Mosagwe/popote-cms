  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" >
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/admin/dashboard')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      @if(Auth::guard()->check())
      <li class="nav-item">
        <a class="nav-link"  href="{{url('/admin/logout')}}" >
          Logout
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="{{url('/admin/logout')}}" > My Account </a></li>
  @else
  <li class="nav-item">
    <a class="nav-link"  href="{{url('/admin/logout')}}" > Logout </a></li>
    @endif
    </ul>
  </nav>
  <!-- /.navbar -->