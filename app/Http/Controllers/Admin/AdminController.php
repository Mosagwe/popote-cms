<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Image;
use Session;
use App\Models\User;
use \App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function settings()
    {
// echo "<pre>"; print_r( Auth::guard('admin')->user());die;
Session::put('page','settings');
        $adminDetails = Admin::Where('email', Auth::guard('admin')->user()->email)->first();
        return view("admin.admin_auth.admin_settings")->with(compact("adminDetails"));
    }
    public function dashboard()
    {
    Session::put('page','dashboard');
        return view('admin.admin_dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // $validated = $request->validate([
            //     'email' => 'required|email|max:255',
            //     'password' => 'required',
            // ]);
            $rules = ['email' => 'required|email|max:255',
                'password' => 'required'];
            $custommessage = [
                'email.required' => 'email is required',
                'email.email' => 'invalid email address',
                'password.required' => 'password is require',
            ];
            $this->validate($request, $rules, $custommessage);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            } else {
                Session::flash('error_message', 'invalid email or password');
                return redirect()->back();
            }
        }
        return view('admin.admin_auth.admin_login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function chkCurrentPassword(Request $request)
    {
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            echo "true";
        } else {
            echo "false";
        }
    }
    
    public function confirmPassword(Request $request)
    {
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        if (Hash::check($data['confirm_password'],$data['password'])) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function updateCurrentPassword(Request $request)
    {
       
        if ($request->isMethod('post')) {
            $data = $request->all();
            //check if current password is correct
            if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
                //chwck for password match

                if ($data['new_pwd'] == $data['confirm_pwd']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
                    Session::flash('success_message', 'Passwords updated successfully');
                } else {
                    Session::flash('error_message', 'Passwords do not match');

                }
            } else {
                Session::flash('error_message', 'Your current password is incorect');
            }
            return redirect()->back();
        }
    }

    public function updateAdminDetails(Request $request)
    {
        Session::put('page','update-admin-details');
        $adminDetails = Admin::Where('email', Auth::guard('admin')->user()->email)->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            //  echo "<pre>"; print_r($data); die;
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:14',
                'admin_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            ];
            $custommessage = [
                'admin_name.required' => 'Name is Required',
                'admin_name.alpha' => 'Valid Name is Required',
                'admin_mobile.required' => 'mobile phone is require',
                'admin_mobile.numeric' => 'a valid phone number is required',
                'admin_mobile.min' => 'phone number digits at least 10',
                'admin_mobile.max' => ' phone number digits cannot exceed 10',
                'admin_image.mimes' => 'image file required',
            ];
            $this->validate($request, $rules, $custommessage);
//upload the image

if($request->hasFile('admin_image')){
    $image_tmp = $request->file('admin_image');
    if($image_tmp->isValid()){
        // Get Image Extension
        $extension = $image_tmp->getClientOriginalExtension();
        // Generate New Image Name
        $imageName = rand(111,99999).'.'.$extension;
        $imagePath = 'images/admin_images/'.$imageName;
        // Upload the Image
        Image::make($image_tmp)->resize(300,400)->save($imagePath);
    }
}else if(!empty($data['current_admin_image'])){
    $imageName = $data['current_admin_image'];
}else{
    $imageName = "";
}
            
            //update the admin_details
            Admin::where('email', Auth::guard('admin')->user()->email)
                ->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile'], 'image' => $imageName]);
            Session::flash('success_message', 'Admin details updated successfully !');
        }
        return view('admin.admin_auth.update_admin_details')->with(compact('adminDetails'));
    }

    public function registerFormShow(){
        return view ('admin.admin_auth.register');
    }


    public function registerAdmin(Request $request){
if ($request->isMethod('post')){

    $data= $request->all();

  
    //check if user exist
    $userCount=Admin::where('email',$data['email'])->count();
    if($userCount>0){
        $message= 'email already exist';
        session::flash('error_message',$message);
 return redirect()->back();

    }else{
        //register user
        
        $admin= new Admin;
        $admin->type='admin';
        $admin->name=$data['name'];
        $admin->mobile=$data['mobile'];
        $admin->email=$data['email'];
        $admin->password=bcrypt($data['password']);
        $admin->save();
        return redirect('admin/dashboard');
    
    }
}
    }
}
