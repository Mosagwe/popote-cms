
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
                <h3 class="card-title">Services</h3>
                <a href="{{route('admin.services.create')}}" class="btn btn-block btn-success" 
                style="max-width: 150px; float:right; display:inline-block;"> Add Service</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="categories" class="table table-bordered table-striped">
                  <thead style="background-color:grey" >
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($services as $service)          
                  <tr>
                    <td>{{$service->id}}</td>
                    <td>{{ \Illuminate\Support\Str::limit($service->servicename,30)}}</td>  
                    <td>{{ \Illuminate\Support\Str::limit($service->details,50)}}</td> 

                    <td>@if ($service->status==1)
                      <a class="updateServiceStatus"  id="service-{{$service->id}}" service_id={{$service->id}}
                          href="javascript:void(0)">Active</a>
                      @else 
                      <a class="updateServiceStatus"   id="service-{{$service->id}}" service_id ="{{$service->id}}"
                          href="javascript:void(0)">InActive</a>
                      @endif
                  </td>

                  <td class="text-centre">
                    <a href="{{route('admin.services.edit',$service->id)}}" class="btn btn-warning">
                      Edit service </a>                    
               <form action="{{route('admin.services.destroy',$service->id)}}" name="Service" method="POST" class="d-inline"
                onsubmit="return confirm('are you sure you want to delete service?!')">
                 @method('delete')
                 @csrf
              <button class="btn btn-danger ">Delete service</button>

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

