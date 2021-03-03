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
                <h3 class="card-title">Centres</h3>
                <a href="{{route('admin.centres.create')}}" class="btn btn-block btn-success" 
                style="max-width: 150px; float:right; display:inline-block;"> Add Centre</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="categories" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Name</th>
                
                    <th>Action</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($centres as $centre)          
                  <tr>
                    <td>{{$centre->id}}</td>
                    <td>{{$centre->code}}</td> 
                    <td>{{$centre->name}}</td>  
                    
                  <td class="text-centre">
                    <a href="{{route('admin.centres.show',$centre->id)}}" class="btn btn-info">View services</a> <a href="{{route('admin.centres.edit',$centre->id)}}" class="btn btn-warning">
                      Edit centre </a>
                      {{-- <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"  class="btn btn-danger disabled">
                        Delete centre </a>
                        <form action="{{route('admin.centres.destroy',$centre->id)}}"  method="POST">@csrf 
                          @method('DELETE')
                        </form>  --}}
               <form action="{{route('admin.centres.destroy',$centre->id)}}" method="POST" class="d-inline"
                onsubmit="return confirm('are you sure you want to delete centre?!')">
                 @method('delete')
                 @csrf
              <button class="btn btn-danger ">Delete Centre</button>

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