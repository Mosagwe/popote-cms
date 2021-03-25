  
  @extends('layouts.admin_layout.admin_layout')
  @section('content')

    <style>
          .content-wrapper{
           background-image:url('/images/background.jpeg')
          }
        
        </style>
        
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              {{-- <h1 class="m-0 text-dark">Dashboard</h1> --}}
            </div><!-- /.col -->
           
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
       
          <div class="row" >
            <div class="col-md-6">
          <div class=" split left">
            <div class="centred">
              <img src="{{asset('images/hudumalogo.png') }}" alt="no Home image">
              <br><br>
              <p>welcome to the Huduma Kenya Popote_Ufe Admin Panel</p>
              
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="split right">
            <div class="centred">
              {{-- <img src="{{asset('images/hudumalogo.png') }}" alt="no Home image"> --}}
              <h2 style="color: grey">Huduma Kenya Popote_Ufe Admin Panel</h2>
              <br>
              <p>Huduma Kenya Programme is a Government of Kenya initiative 
                whose aim is to turn around public service delivery by providing 
                efficient and accessible Government services at the convenience of 
                citizens through various integrated service delivery platforms. 
                The Ministry of Public Service Youth and Gender Affairs is implementing 
                the programme through the Huduma Kenya Secretariat.</p>

            </div>
          </div>
        </div>
      </div>
         
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  @endsection
  