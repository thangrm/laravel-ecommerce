<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImg;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class IndexController extends Controller
{
    public function index(){
        $categories = Category::orderBy('category_name','ASC')->get();
        $subCategories = SubCategory::orderBy('subcategory_name', 'ASC')->get();
        $subSubCategories = SubSubCategory::orderBy('subsubcategory_name', 'ASC')->get();
        $sliders = Slider::where('status',1)->latest()->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->limit(6)->get();
        $features = Product::where([['status',1],
                                    ['featured',1]])->orderBy('id','DESC')->limit(6)->get();

        $hotDeals = Product::where([['status',1],
                                    ['hot_deals',1]])->orderBy('id','DESC')->limit(3)->get();

        $specialOffers = Product::where([['status',1],
                                    ['special_offer',1]])->orderBy('id','DESC')->limit(3)->get();

        $specialDeals = Product::where([['status',1],
                ['special_deals',1]])->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.index',compact(['categories','subCategories','subSubCategories',
                'sliders','products','features','hotDeals','specialOffers','specialDeals']));
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

    public function productDetails($id){
        $product = Product::findOrFail($id);
        $multiImage = ProductImg::where('product_id',$id)->get();
        return view('frontend.product.product_details',compact('product','multiImage'));
    }
}
