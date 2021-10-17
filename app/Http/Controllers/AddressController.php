<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function getProvinces(){
        $provinces = DB::table('provinces')->orderBy('name')->get();
        return response()->json($provinces);
    }

    public function getDistricts($provinceId){
        $district = DB::table('districts')->orderBy('name')
                ->where('province_id',$provinceId)->get();
        return response()->json($district);
    }

    public function getWards($districtId){
        $wards = DB::table('wards')->orderBy('name')
                ->where('district_id',$districtId)->get();
        return response()->json($wards);
    }
}
