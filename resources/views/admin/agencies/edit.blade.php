@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Services</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Services</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

            @if ($errors->any())
            <div class="alert alert-danger" style="margin-top:10px">
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
            </ul>
            </div>               
            @endif
          <form name="categoryForm" id="categoryForm" action="{{route('admin.services.store')}}" 
          method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Edit Agency form</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          
            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label >Agency Name</label>
                    <input type="text" class="form-control" value="{{$agency->name}}" id="servicename" name="servicename" placeholder="Enter Service name">
                  </div>
                  
                  <div class="form-group">
                    <label >Agency code</label>
                    <input type="text" class="form-control" value="{{$agency->code}}" id="servicename" name="servicename" placeholder="Enter Service name">
                  </div>                
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label >AGENCY lOGO</label>
                  <input type="file" class="form-control" id="mda_logo" name="mda_logo" value="">
                  @if (!empty($agency->mda_logo))
                  <a target="_blank" href="{{url('images/admin_images/admin_photos/', $agency->mda_logo)}}">{{$agency->mda_logo}}</a>
                  @else
             <p style="color: red">No added Agency logo</p>                            
                  @endif
                </div>
                               
              </div>  
            
            </div> 
          </div>
    
          <div class="card-footer">
           <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
    </form>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection