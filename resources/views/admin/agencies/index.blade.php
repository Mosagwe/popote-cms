@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agencies</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Agencies</li>
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
               
            @if (Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px">
          {{Session::get('success_message')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

            <div class="card">
          </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Agencies</h3>
                <a href="{{route('admin.mdas.create')}}" class="btn btn-block btn-success" 
                style="max-width: 150px; float:right; display:inline-block;"> Add Agency</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="categories" class="table table-bordered table-striped">
                  <thead style="background-color: grey" >
                  <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Name</th>                    
                    <th>Action</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($mdas as $mda)          
                  <tr>
                    <td>{{$mda->id}}</td>
                    <td>{{$mda->code}}</td>
                  <td>{{\Illuminate\Support\Str::limit($mda->name,40)}}</td>              
                  <td class="text-centre">
                    <a href="{{route('admin.mdas.show',$mda->id)}}" class="btn btn-info">View services</a> <a href="{{route('admin.mdas.edit',$mda->id)}}" class="btn btn-warning">
                      Edit Agency </a>
                    
               <form action="{{route("admin.mdas.destroy",$mda->id)}}" method="POST" class="d-inline"
                onsubmit="return confirm('are you sure you want to delete Agency?!')">
                 @method('delete')
                 @csrf
              <button class="btn btn-danger ">Delete Agency</button>

               </form>
              
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
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