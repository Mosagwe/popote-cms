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
        return view('admin.centres.centres')->with(compact('centres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.centres.add_centre');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Centre $centre)
    {
        $centre->id= $request->id;
        $centre->code= $request->code;
        $centre->name= $request->name;
        $centre->status= $request->status;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Centre $centre)
    {
       $centre=$centre;
       return view('admin.centres.edit_centre')->with(compact('centre'));
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

        $centre->id= $request->id;
        $centre->code= $request->code;
        $centre->name= $request->name;
        $centre->status= $request->status;
        $centre->save();
    
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
}
