<?php

namespace App\Http\Controllers\Admin;

use App\Models\Centre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

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
'code'=>'required|regex:/^[a-zA-Z0-9_-]*$/',
];
$custommessage=[
'name.requires'=>'Centre name is required',
'name.alpha'=>'valid centre name is required',
'code.required'=>'centre code  is required',
'code.alpha'=>'A valid centre code is required'
];
$this-> validate($request,$rules,$custommessage);
        
        $centre->code= $request->code;
        $centre->name= $request->name;
        $centre->status=1;
        $centre->save();
        Session::flash('success_message','centre added successfully');
        return redirect()->route('admin.centres.index');

        
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
            'code'=>'required|regex:/^[a-zA-Z0-9_-]*$/',
            ];
            $custommessage=[
            'name.requires'=>'Centre name is required',
            'name.alpha'=>'valid centre name is required',
            'code.required'=>'centre code  is required',
            'code.alpha'=>'A valid centre code is required'
            ];
            $this-> validate($request,$rules,$custommessage);
    
            $centre->name= $request->name;
            $centre->code= $request->code;
        
    
        $centre->save();
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
}
