<?php

namespace App\Http\Controllers\Admin;

use Image;
use Session;
use App\Models\Upload;
use Illuminate\Http\Request;
use App\Models\UploadedImage;
use App\Models\UploadedVideo;
use App\Http\Controllers\Controller;

class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('page','uploads');
        return view('admin.uploads.uploads');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,Upload $upload)
    {

        $rules = [
        
            'upload_file' => 'mimes:pdf,zip|required',
        ];
        $custommessage = [
          
          
            'upload_file.required' => ' a document is required',
        ];
        $this->validate($request, $rules, $custommessage);
$filenameWithExt = $request->file('upload_file')->getClientOriginalName();
//Get just filename
$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
// Get just ext
$extension = $request->file('upload_file')->getClientOriginalExtension();
// Filename to store
$fileNameToStore = $filename.'_'.time().'.'.$extension;
// Upload Image
$path = $request->file('upload_file')->store($fileNameToStore, 'public');

$upload->file_name = $fileNameToStore ;

$upload->save(); 
Session::flash('success_message','File uploaded successfully');
       return redirect()->back();

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
    public function edit($id)
    {
        //
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
        //
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

public function uploadImage(Request $request, UploadedImage $uploadedImage){
    $rules = [
        
        'upload_image' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000',
    ];
    $custommessage = [
      
        'upload_image.required'=>'Agency logo is required',
        'upload_image' => 'image file required',
    ];
    $this->validate($request, $rules, $custommessage);
    
    if($request->hasFile('upload_image')){
  
        $image_tmp = $request->file('upload_image');
        if($image_tmp->isValid()){
            // Get Image Extension
            $filenameWithExt = $request->file('upload_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('upload_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $imagePath = 'uploads/'.$fileNameToStore;
            // Upload the Image
            Image::make($image_tmp)->resize(300,400)->save($imagePath);
        }
    }else{
        $fileNameToStore = "";
    }
  
    $uploadedImage->file_name=$fileNameToStore;
    $uploadedImage->save();
    Session::flash('success_message','Agency added successfully');
return redirect()->back();

}
public function uploadVideo(Request $request, UploadedVideo $uploadedVideo ){
   
    $rules = [
        
        'upload_video' => 'max:20000|mimes:mp4,ogx,oga,ogv,ogg,webm',
    ];
    $custommessage = [

        'upload_video.required' => ' a document is required',
          'upload_video.max' => ' file too big',
    ];
    $this->validate($request, $rules, $custommessage);

$filenameWithExt = $request->file('upload_video')->getClientOriginalName();
//Get just filename
$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
// Get just ext
$extension = $request->file('upload_video')->getClientOriginalExtension();
// Filename to store
$fileNameToStore = $filename.'_'.time().'.'.$extension;
// Upload Image
$path = $request->file('upload_video')->store($fileNameToStore, 'public');

$uploadedVideo->file_name = $fileNameToStore ;

$uploadedVideo->save(); 
Session::flash('success_message','Video uploaded successfully');
   return redirect()->back();
}
}
