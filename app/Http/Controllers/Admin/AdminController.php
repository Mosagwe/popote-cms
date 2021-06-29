<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Image;
use Session;
use Reminder;
use App\Models\User;
use \App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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
                Session::forget('success_message');
                return redirect()->back();
            }
        }
        return view('admin.admin_auth.admin_login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
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
        if (Hash::check($data['new_pwd'],$data['confirm_pwd'])) {
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
                'admin_image' => 'image|mimes:jpeg,jpg,png,gif|required|max:10000',
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
        $imagePath = 'images/admin_images/admin_photos/'.$imageName;
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


    public function registerAdmin(Request $request ){
      
  
    $rules = [
    'name'=>'required|regex:/\A(?!.*[:;]-\))[ -~]{3,20}\z/',
    'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
    'admin_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
    'email' => 'required|email|max:255',
    'password' => 'required',
    'confirm_password'=>'required|same:password'

   
];

$custommessage = [
'email.required' => 'email is required',
'email.email' => 'invalid email address',
'type.required'=>' Admin type is required',
'password.required' => 'password is required',
'name.required'=>'admin name is required',
'mobile.required' => 'phone number is required',
'mobile.numeric' => 'valid phone number is required',
'mobile.min' => 'phone number digits at least 10',
'mobile.max' => ' phone number digits cannot exceed 10',
'admin_image.required'=>'admin image is required',
'confirm_password.required'=>'confirm password is required',
'confirm_password.same'=>'passwords do not match'

];
$this->validate($request, $rules, $custommessage);

    
if($request->hasFile('admin_image')){
    $image_tmp = $request->file('admin_image');
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

      //check if user exist
      $userCount=Admin::where('email',$request->email)->count();
      if($userCount>0){
          $message= 'email already exist';
          session::flash('error_message',$message);
   return redirect()->back();
  
      }  
      
      $admin= new Admin;
      $admin->name=$request->name;
      $admin->mobile=$request->mobile;
      $admin->type='admin';
      $admin->image= $imageName;
      $admin->email=$request->email;
      $admin->password=bcrypt($request->password);
    //   dd($admin);
      $admin->save();
  
   return redirect('admin/dashboard');

}

public function forgotPassword(Request $request){
if ($request->isMethod('post')){
    $data= $request->all();
    // dd($data);die;
    // //  echo "<pre>"; print_r($data); die;
    $emailCount = Admin::where('email',$data['email'])->count();
    if($emailCount==0){
$message ="Email doent exist!";
Session::put('error_message',$message);
Session::forget('success_message');
return redirect()->back();
    }
  //generate randorm password
$random_password= str_random(8);

 //ecode password
 $new_password = bcrypt($random_password);

 // update password
 Admin::where('email',$data['email'])->update(['password'=>$new_password]);

 //get username
$userName= Admin::select('name')->where('email',$data['email'])->first();

//send forgot password email
$emailAddress= $data['email'];
$name =$userName->name;
$messageData =[
    'email'=>$emailAddress,
    'name'=>$name,
    'password'=>$random_password

];
Mail::send('admin.emails.forgot_password',$messageData, function($message)use($emailAddress){
$message->to($emailAddress)->subject('New Password - UFE Admin panel');
});
//redirect to login
$message ='Please check your Email for a new Password.';
Session::put('success_message',$message);
Session::forget('error_message');
return redirect('/');
}
    return view('admin.admin_auth.forgot_password');
}
  

}
