
  
  @extends('layouts.admin_layout.admin_layout')
  @section('content')
        
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="align-items: center" >
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Services</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">services</li>
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
                  <h3 class="card-title">Edit services form</h3>
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
                <form role="form" method="post"  name="categoryForm" action="{{route('admin.services.update',$service->id)}}" 
                id="categoryForm" enctype="multipart/form-data">@csrf
                @method('put')
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                  <div class="form-group">
                      <label >Services Name</label>
                      <input type="text" class="form-control" value="{{$service->servicename}}" id="servicename" name="servicename" placeholder="Enter Service name">
                    </div>
                    <div class="form-group">
                      <label >Services Details</label>
                      <textarea class="form-control" name="details"  id="details" rows="3"  placeholder="Enter Service details">{{$service->details}}</textarea>   
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label >Services cost</label>
                      <input type="text" class="form-control" value="{{$service->cost}}" id="cost" name="cost" placeholder="Enter Service cost">
                    </div>   
                    <div class="form-group">
                      <label >Services timeline</label>
                      <input type="text" class="form-control" value="{{$service->timeline}}" id="timeline" name="timeline" placeholder="Enter Service timeline">
                    </div>
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
  





