<?php

namespace App\Http\Controllers\Admin;

use App\Models\Centre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class CentresController extends Controller
{
public function centres(){
    $centres = Centre::get();
Session::put('page','centres');
return view('admin.centres.centres')->with(compact('centres'));
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
