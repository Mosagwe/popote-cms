<?php

namespace App\Http\Controllers\Admin;

use Image;
use Session;
use App\Models\Mda;
use App\Models\Centre;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MdasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mdas = Mda::get();
     
        Session::put('page','agencies');
        return view('admin.agencies.index')->with(compact('mdas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Mda $mda)
    {
        
        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'code' => 'required',
            'mda_logo' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ];
        $custommessage = [
            'name.required' => 'Name is Required',
            'name.alpha' => 'Valid Name is Required',
            'mda_logo.required'=>'Agency logo is required',
            // 'mda_logo.mimes' => 'image file required',
        ];
        $this->validate($request, $rules, $custommessage);
        
        if($request->hasFile('mda_logo')){
            $image_tmp = $request->file('mda_logo');
            if($image_tmp->isValid()){
                // Get Image Extension
                $extension = $image_tmp->getClientOriginalExtension();
                // Generate New Image Name
                $imageName = rand(111,99999).'.'.$extension;
                $imagePath = 'images/mda_logos/'.$imageName;
                // Upload the Image
                Image::make($image_tmp)->resize(300,400)->save($imagePath);
            }
        }else{
            $imageName = "";
        }
        $mda->name=$request->name;
        $mda->code=$request->code;
        $mda->mda_logo=$imageName;
        $mda->save();
        Session::flash('success_message','Agency added successfully');
return redirect()->route('admin.mdas.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        $mda=Mda::find($id);
        return view('admin.agencies.show',compact('mda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mda= Mda::find($id);
      
        return view('admin.agencies.edit')->with(compact('mda'));
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
      
$data=$request->all();

        if($request->hasFile('mda_logo')){
            $image_tmp = $request->file('mda_logo');
            if($image_tmp->isValid()){
                // Get Image Extension
                $extension = $image_tmp->getClientOriginalExtension();
                // Generate New Image Name
                $imageName = rand(111,99999).'.'.$extension;
                $imagePath = 'images/mda_logos/'.$imageName;
                // Upload the Image
                Image::make($image_tmp)->resize(300,400)->save($imagePath);
            }
        }else if(!empty($data['current_mda_logo'])){
            $imageName = $data['current_mda_logo'];
        }else{
            $imageName = "";
        }
        $mda= Mda::find($id);

        $mda->name=$request->name;
        $mda->code=$request->code;
        $mda->mda_logo=$imageName;
        $mda->save();
        dd($mda);
        Session::flash('success_message','Agency edited successfully');
return redirect()->route('admin.mdas.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mda::destroy($id);
        return redirect()->route('admin.mdas.index');
    }

    public function createAgencyService($id){
        $mda =Mda::find($id);
        $centres= Centre::all();
        return view('admin.agencies.createAgencyService')->with(compact('mda','centres'));
    }
    public function storeAgencyService(Request $request, Service $service){


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
       return redirect()->route('admin.mdas.index');
    }

 
}
