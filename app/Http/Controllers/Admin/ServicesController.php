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
    private $centres;
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
            'details'=>'required|regex:/^[\pL\s\-]+$/u',
            ];
            $custommessage=[
            'servicename.requires'=>'Centre name is required',
            'details.required'=>'service details  is required',
            
            ];
            $this-> validate($request,$rules,$custommessage);

    
       if(in_array('all',$request->centre_id)){
          $centres=Centre::all()->pluck('id');
                  
       }
       else{
            $centres=Centre::find($request->centre_id)->pluck('id');
       }


        $service->servicename= $request->servicename;
        $service->details= $request->details;
        $service->mda_id= $request->mda_id;
        $service->cost =$request->cost;
        $service->timeline=$request->timeline;
        $service->sbaservice_id=0;
       $service->save();
        $centre= $centres;
        $service->centres()->attach($centre);
        Session::flash('success_message', 'service added successfully');
       return redirect()->route('admin.services.index');
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
        //   $mdas=Mda::all();
        // $centres=Centre::all();
        return view('admin.services.edit',compact('service'));
      
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
        $service->cost= $request->cost;
        $service->timeline= $request->timeline;
        // $service->mda_id= $request->mda_id;
        // $service->sbaservice_id=0;
        $service->save();
        Session::flash('success_message', 'service edited successfully');
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
        Service::destroy($id);
        Session::flash('success_message','Service deleted successfully');
        return redirect()->route('admin.services.index');
    }
 


    public function updateServiceStatus(Request $request){
    
        if($request->ajax()){
            $data= $request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            Service::where('id',$data['service_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'service_id'=>$data['service_id']]);
        }
    }

    
}
