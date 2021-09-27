<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class IndexController extends Controller
{
    public function index(){
        return view('frontend.index');
    }

    public function userLogout(){
        Auth::guard('web')->logout();
        return Redirect()->route('login');
    }

    public function userProfile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.show', compact('user'));
    }

    public function userPassword(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.password', compact('user'));
    }

    public function editProfile(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $user['profile_photo_path'] = $filename;
        }
        $user->save();
        $data = array(
                'message' => 'User Profile Updated Successfully',
                'alert-type' => 'success',
                'user' =>$user
        );
        return redirect()->route('user.profile')->with($data);
    }

    public function changePassword(Request $request){
        $validate = $request->validate([
                'oldpassword' => 'required',
                'password' => 'required|confirmed'
        ]);
        $id = Auth::user()->id;
        $hashedPassword = User::find($id)->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $admin = User::find($id );
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::guard('web')->logout();
            return redirect('/login');
        }else{
            $notification = array(
                    'message' => 'Old Password Incorrect',
                    'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
