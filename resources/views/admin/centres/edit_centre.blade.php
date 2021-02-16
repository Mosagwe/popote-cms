@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Centres</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Centres</li>
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
          <form name="categoryForm" id="categoryForm" action="{{route('admin.centres.update',$centre->id)}}" 
          method="post" enctype="multipart/form-data">@csrf
          @method('PUT')
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Edit centre form</h3>
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
                    <label >Centre Id</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{$centre->id}}" placeholder="Enter Category Discount">
                  </div>
                  <div class="form-group">
                    <label >Centre code</label>
                    <input type="text" class="form-control" name="code" id="code" value="{{$centre->code}}" rows="3" placeholder="Enter category description"> 
                  </div>                
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label >Centre Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$centre->name}}" placeholder="Enter Category Discount">
                  </div>
                  <div class="form-group">
                    <label >status</label>
                    <input type="text" class="form-control" name="status" id="status" value="{{$centre->status}}" rows="3" placeholder="Enter category description"> 
                  </div>                
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