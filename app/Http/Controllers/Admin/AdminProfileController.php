<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function profile(){
        $admin = Admin::find(1);
        return view('admin.profile.show',compact('admin'));
    }

    public function edit(Request $request){
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;
        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();
        $notification = array(
                'message' => 'Admin Profile Updated Successfully',
                'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    }

    public function password(Request $request){
        $validate = $request->validate([
           'oldpassword' => 'required',
           'password' => 'required|confirmed'
        ]);

       $hashedPassword = Admin::find(1)->password;
       if(Hash::check($request->oldpassword,$hashedPassword)){
           $admin = Admin::find(1);
           $admin->password = Hash::make($request->password);
           $admin->save();
           Auth::logout();
           return redirect()->route('admin.logout');
       }else{
           $notification = array(
                   'message' => 'Old Password Incorrect',
                   'alert-type' => 'error'
           );
           return redirect()->back()->with($notification);
       }
    }
}
