<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Mda;
use App\Models\Centre;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services=Service::all();
        Session::put('page','services');
        return view('admin.services.index')->with(compact('services'));
        // $mdas=Mda::has('services')->get();       
        // return view('services.index',compact('mdas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $mdas=Mda::all();
        $centres=Centre::all();  
        return view('admin.services.create',compact('centres','mdas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Service $service)
    {
        $rules=[
            'servicename'=>'required|regex:/^[\pL\s\-]+$/u',
            'detail'=>'required|regex:/^[a-zA-Z0-9_-]*$/',
            ];
            $custommessage=[
            'servicename.requires'=>'Centre name is required',
            'servicename.alpha'=>'valid centre name is required',
            'details.required'=>'centre code  is required',
            'details.alpha'=>'A valid centre code is required'
            ];
            $this-> validate($request,$rules,$custommessage);
        $service->servicename= $request->servicename;
        $service->details= $request->details;
        $service->mda_id= $request->mda_id;
        $service->sbaservice_id=0;
        $service->save();
        $centre= Centre::find($request->centre_id);
        $service->centres()->attach($centre);

       return redirect('/admin/services');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
          $service=$service;
          $mdas=Mda::all();
        $centres=Centre::all();
        return view('admin.services.edit',compact('mdas','centres','service'));
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $service= Service::find($id);
        $service->servicename= $request->servicename;
        $service->details= $request->details;
        $service->mda_id= $request->mda_id;
        $service->sbaservice_id=0;
        $service->save();
        return redirect('/admin/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function all()
    {
        $services=Service::all();
        Session::put('page','services');
        return view('admin.services.index')->with(compact('services'));
    }

}
