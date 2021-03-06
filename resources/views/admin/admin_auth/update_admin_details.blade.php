  
  @extends('layouts.admin_layout.admin_layout')
  @section('content')
        
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Settings</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Admin Settings</li>
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
                  <h3 class="card-title">Update Admin Details</h3>
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
                <form role="form" method="post"  name="updateAdminDetails" action="{{url('/admin/update-admin-details')}}" 
                id="updateAdminDetails" enctype="multipart/form-data">@csrf
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Admin Email</label>
                      <input  class="form-control" value="{{$adminDetails->email}}" readonly="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Admin type </label>
                      <input  class="form-control" value="{{$adminDetails->type}}" readonly="">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Admin name </label>
                      <input  class="form-control" type="text" value="{{$adminDetails->name}}" placeholder="Enter Admi-name"
                       id="admin_name" name="admin_name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Phone number</label>
                      <input type="text" class="form-control" value="{{$adminDetails->mobile}}"
                       id="admin_mobile" name="admin_mobile" placeholder="Enter Admin Phone Number" accept="image/*">
                     
                    </div>
                    <div class="form-group">
                        <label >Admin Image</label>
                        <input type="file" class="form-control" id="admin_image" name="admin_image">
                        @if (!empty(Auth::guard('admin')->user()->image))
                        <a target="_blank" href="{{url('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image)}}">View current Image</a>
                        <input type="hidden" name="current_admin_image" 
                        value="{{Auth::guard('admin')->user()->image}}">
                            
                        @endif
                      </div>
                    </div>
                  </div>
                     
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
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
  