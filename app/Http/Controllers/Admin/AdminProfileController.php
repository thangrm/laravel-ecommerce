<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function profile(){
        $admin = Admin::find(1);
        return view('admin.profile.show',compact('admin'));
    }
}
