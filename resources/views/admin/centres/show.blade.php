
@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Centres services</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Centres services</li>
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
                <h3 class="card-title">Centres services</h3>
                <a href="{{route('admin.services.create')}}" class="btn btn-block btn-success" 
                style="max-width: 150px; float:right; display:inline-block;"> Add sertvice to Centre</a>
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
                      @foreach ($centre->services as $service)          
                  <tr>
                    <td>{{$service->id}}</td>                
                    <td>{{$service->servicename}}</td>  
                
                  <td class="text-centre">
                    <a href="{{route('admin.centres.show',$centre->id)}}" class="btn btn-info">change status</a> <a href="{{route('admin.services.edit',$service->id)}}" class="btn btn-warning">
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


{{-- 
@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="section-title" style="align-items: center">
            <div class="row">
                <h2 style="color: #721c24">{{ $centre->name }} GOVERNMENT SERVICES</h2> 
            </div>      
        </div>
           <P></P>
            <p></p>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

            <div class="row">
                @foreach($centre->services as $service)
                    <div class="col-lg-4 col-md-4" style="padding-bottom: 4px">
                        <div class="icon-box">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                           
                            <h3><a href="{{route(admin.services.show),$service->id}}">{{ $service->servicename }}</a></h3>
                        </div>
                    </div>
                    <p></p>
                @endforeach
            </div>
            <p></p>


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection


 
 
{{-- 
                <div class="section-title">
                    <h2>Government Services</h2>
                    <p>Get access to a myriad of Government Services and Information.</p>
                </div>


                    <div class="row">

                        <h4 style="color: #721c24">{{ $centre->name }}</h4>
                    </div>
                    <p></p>
                    <div class="row">
                        @foreach($centre->services as $service)
                            <div class="col-lg-4 col-md-4" style="padding-bottom: 4px">
                                <div class="icon-box">
                                    <i class="fa fa-address-book" aria-hidden="true"></i>
                                   
                                    <h3><a href="">{{ $service->servicename }}</a></h3>
                                </div>
                            </div>
                            <p></p>
                        @endforeach
                    </div>
                    <p></p>

            
     --}}

 --}}
