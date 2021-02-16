<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class ServicesController1 extends Controller
{
  public function services(){
    $services=Service::get();
   Session::put('page','services');
    return view('admin.services.services')->with(compact('services'));
  }

  public function add_edit_service(){
    
  }
}
