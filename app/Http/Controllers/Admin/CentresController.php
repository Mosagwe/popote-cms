<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Mda;
use App\Models\Centre;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CentresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centres = Centre::get();
        Session::put('page','Centres');
        return view('admin.centres.index')->with(compact('centres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.centres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Centre $centre)
    {
$rules=[
'name'=>'required|regex:/^[\pL\s\-]+$/u',
'code'=>'required|regex:/^[\w-]*$/',
];
$custommessage=[
'name.requires'=>'Centre name is required',
'code.required'=>'centre code  is required',

];
$this-> validate($request,$rules,$custommessage);
        
        $centre->code= $request->code;
        $centre->name= $request->name;
        $centre->status=1;
        $centre->save();
        Session::flash('success_message','centre added successfully');
        return redirect('admin/centres');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $centre=Centre::findOrFail($id);
        return view('admin.centres.show',compact('centre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $centre= Centre::find($id);
       return view('admin.centres.edit')->with(compact('centre'));
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
        $centre= Centre::find($id);

        $rules=[
            'name'=>'required|regex:/^[\pL\s\-]+$/u',
            'code'=>'required|regex:/^[\w-]*$/',
            ];
            $custommessage=[
            'name.required'=>'Centre name is required',
            'code.required'=>'Centre code  is required',
           
            ];
            $this-> validate($request,$rules,$custommessage);
    
            $centre->name= $request->name;
            $centre->code= $request->code;
    
        $centre->save();
        Session::flash('success_message','Centre Editted successfully');
        return redirect()->route('admin.centres.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Centre::destroy($id);
        Session::flash('success_message','Centre deleted successfully');
        return redirect()->route('admin.centres.index');
    }

    public function updateCentreStatus(Request $request){
        if($request->ajax()){
            $data= $request->all();
            if($data['status']=='Active'){
                $status=0;
            }else{
                $status=1;
            }
            Centre::where('id',$data['centre_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'centre_id'=>$data['centre_id']]);
        }
    }

    public function createCentreService($id){
        $centre = Centre::find($id);
        $mdas =Mda::all();
        return view('admin.centres.createCentreService',compact('centre','mdas'));
    }
public function storeCentreService(Request $request, Service $service){

    $centres=Centre::all()->pluck('id');


    $rules=[
        'servicename'=>'required|regex:/^[\pL\s\-]+$/u',
        'details'=>'required|regex:/^[\pL\s\-]+$/u',
        ];
        $custommessage=[
        'servicename.requires'=>'Centre name is required',
        'details.required'=>'service details  is required',
        
        ];
        $this-> validate($request,$rules,$custommessage);

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
   return redirect()->route('admin.centres.index');
}
}
