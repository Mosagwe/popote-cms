@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
          <form name="categoryForm" id="categoryForm" action="{{url('/admin/add-edit-category')}}" 
          method="post" enctype="multipart/form-data">@csrf
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add category form</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row"> 
              <div class="col-md-6">

                <div class="form-group">
                  <div class="form-group">
                    <label >Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name">
                  </div>
                </div>

                 

                  <div class="form-group">
                    <label>select Category Level</label>
                    <select name="parent_id" class="form-control select2" style="width: 100%;">
                      <option value="0" >Main Category</option>
                    </select>
                  </div>

            
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                 
                <div class="form-group">
                    <label>Category Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="category_image" name="category_image">
                        <label class="custom-file-label" >Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
            
              </div>
          
            </div>      
            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label >Category Discount</label>
                    <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Enter Category Discount">
                  </div>
                  <div class="form-group">
                    <label >Category Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter category description"></textarea>   
                  </div>                
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label >Category Url</label>
                    <input type="text" class="form-control" name="url" id="url" placeholder="Enter Category Url">
                  </div>
                <div class="form-group">
                    <label>Meta Title</label>
                    <textarea class="form-control" rows="3" name="meta_title" id="meta_title " placeholder="Enter Meta title"></textarea>
                  </div>
              </div>

              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label >meta description</label>
                    <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                  </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label >Meta Keywords</label>
                    <textarea id="meta_keywords" name="meta_keywords" class="form-control" rows="3" placeholder="Enter ..."></textarea>
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