<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Image;

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
        
        if($request->hasFile('mda_logo')){
            $image_tmp = $request->file('mda_logo');
            if($image_tmp->isValid()){
                // Get Image Extension
                $extension = $image_tmp->getClientOriginalExtension();
                // Generate New Image Name
                $imageName = rand(111,99999).'.'.$extension;
                $imagePath = 'images/admin_images/admin_photos/'.$imageName;
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
      

        if($request->hasFile('mda_logo')){
            $image_tmp = $request->file('mda_logo');
            if($image_tmp->isValid()){
                // Get Image Extension
                $extension = $image_tmp->getClientOriginalExtension();
                // Generate New Image Name
                $imageName = rand(111,99999).'.'.$extension;
                $imagePath = 'images/admin_images/admin_photos/'.$imageName;
                // Upload the Image
                Image::make($image_tmp)->resize(300,400)->save($imagePath);
            }
        }else{
            $imageName = "";
        }
        $mda= Mda::find($id);

        $mda->name=$request->name;
        $mda->code=$request->code;
        $mda->mda_logo=$imageName;
        $mda->save();
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
}
