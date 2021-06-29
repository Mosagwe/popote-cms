@extends('layouts.admin_layout.admin_layout')
@section('content')

<style>
  .breadcrumb-item{
    display: inline;
    color: green;
    font-weight: 700;

  }


</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Uploads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item" ><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Uploads</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
          </div>
            <!-- /.card -->

            <div class="card" >
              <div class="card-header" style="background: cadetblue; item-align:center">
                <p ><b>Welcome to the uploads page</b></p>

              </div>
             
              <!-- /.card-header -->
              <div class="card-body">


                
                @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px">
              {{Session::get('success_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif

                {{-- <h3 class="card-title">Tenders</h3> --}}
                <form action="{{route('admin.uploads.store')}}" method="POST" enctype="multipart/form-data">@csrf

                  <span style="color: red" >{{$errors->first('upload_file')}}</span>  
                  <div class="form-group">
                    <div class="col-6">
                    <label >upload Documents</label>
                    <input type="file" class="form-control" id="upload_file" name="upload_file"  required>
                  </div>
                  </div> 

              <button class="btn btn-block btn-success"  
            style="max-width: 150px;  display:inline-block;" >Upload tender</button>
  
                </form>
                <br><br>

                <form action="{{url('admin/upload-video')}}" method="POST" enctype="multipart/form-data">@csrf

                  <span style="color: red" >{{$errors->first('upload_video')}}</span>  
                  <div class="form-group">
                    <div class="col-6">
                    <label >Upload videos</label>
                    <input type="file" class="form-control" id="upload_video" name="upload_video" value="{{old('upload_video')}}"  required>
                  </div>
                  </div> 

              <button class="btn btn-block btn-success"  
            style="max-width: 150px;  display:inline-block;" >Upload Video</button>
  
                </form>
                <br><br>
                <form action="{{url('admin/upload-image')}}" method="POST" enctype="multipart/form-data">@csrf

                  <span style="color: red" >{{$errors->first('upload_image')}}</span>  
                  <div class="form-group">
                    <div class="col-6">
                    <label >upload images</label>
                    <input type="file" class="form-control" id="upload_image" name="upload_image"  required>
                  </div>
                  </div> 

              <button class="btn btn-block btn-success"  
            style="max-width: 150px;  display:inline-block;" >Upload Image</button>
  
                </form>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection