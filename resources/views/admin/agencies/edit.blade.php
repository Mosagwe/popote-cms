
  @extends('layouts.admin_layout.admin_layout')
  @section('content')
        
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Agencies</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Agencies</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Agency Form</h3>
                </div>
                  <!-- /.card-header -->

                @if (Session::has('error_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px">
              {{Session::get('error_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif

                @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px">
              {{Session::get('success_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 10px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
              
                <!-- form start -->
                <form role="form" method="post"  name="createagencyForm" action="{{route('admin.mdas.update',$mda->id)}}"
                id="createagencyForm" enctype="multipart/form-data">@csrf
                @method('PUT')
                  <div class="card-body">               
            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label >Agency Name</label>
                    <input type="text" class="form-control" value="{{$mda->name}}" id="name" name="name" placeholder="Enter Service name">
                  </div>
                  
                  <div class="form-group">
                    <label >Agency code</label>
                    <input type="text" class="form-control" value="{{$mda->code}}" id="code" name="code" placeholder="Enter Service name">
                  </div>                
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label >AGENCY lOGO</label>
                  <input type="file" class="form-control" id="mda_logo" name="mda_logo" value="">
                  @if (!empty($mda->mda_logo))
                  <a target="_blank" href="{{url('images/admin_images/admin_photos/', $mda->mda_logo)}}">{{$mda->mda_logo}}</a>
                  <input type="hidden" name="current_mda_logo" 
                  value="{{$mda->mda_logo}}">
                  @else
             <p style="color: red">No added Agency logo</p>                            
                  @endif
                </div>
                               
              </div>  
            
            </div> 
                     
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
           
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  @endsection
  


