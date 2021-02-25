
@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agency services</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Agency services</li>
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Agency services</h3>
                <a href="{{route('admin.services.create')}}" class="btn btn-block btn-success" 
                style="max-width: 150px; float:right; display:inline-block;"> Add sertvice to Agency</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="categories" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>                
                    <th>Service Name</th>              
                    <th>Action</th>                   
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($mda->services as $service)          
                  <tr>
                    <td>{{$service->id}}</td>                
                    <td>{{$service->servicename}}</td>  
                
                  <td class="text-centre">
                    <a href="" class="btn btn-info">change status</a> <a href="{{route('admin.services.edit',$service->id)}}" class="btn btn-warning">
                      Edit service </a>
                      {{-- <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()"  class="btn btn-danger disabled">
                        Delete centre </a>
                        <form action="{{route('admin.centres.destroy',$centre->id)}}"  method="POST">@csrf 
                          @method('DELETE')
                        </form>  --}}
               <form action="" method="POST" class="d-inline"
                onsubmit="return confirm('are you sure you want to delete centre?!')">
                 @method('delete')
                 @csrf
              <button class="btn btn-danger disabled">Delete service</button>

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



   
 
 
