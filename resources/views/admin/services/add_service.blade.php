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
            <h3 class="card-title">Add services form</h3>
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
                    <label >Services Name</label>
                    <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Enter Service name">
                  </div>
                  <div class="form-group">
                    <label >Services Details</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Service details"></textarea>   
                  </div>                
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label>select Agency</label>
                  <select name="parent_id" class="form-control select2" style="width: 100%;">
                    <option value="0" >KRA</option>
                  </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <textarea class="form-control" rows="3" name="meta_title" id="meta_title " placeholder="Enter service status"></textarea>
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