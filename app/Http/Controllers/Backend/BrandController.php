<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Image;

class BrandController extends Controller
{
    public function BrandView()
    {
        $brands = Brand::latest()->get();

        return view('admin.brand.view', compact('brands'));
    }

    public function BrandStore(Request $request)
    {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_vn' => 'required',
            'brand_image'   => 'required',
        ], [
            'brand_name_en.required' => 'Enter brand name english',
            'brand_name_vn.required' => 'Enter brand name vietnam',
            'brand_image.required'   => 'Choose brand image',
        ]);
        $image    = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_vn' => $request->brand_name_vn,
            'brand_slug_en' => Str::slug($request->brand_name_en),
            'brand_slug_vn' => Str::slug($request->brand_name_vn),
            'brand_image'   => $save_url,
        ]);

        $notification = array(
            'message'    => 'Brand Inserted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function BrandEdit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function BrandUpdate(Request  $request)
    {
        $brandId = $request->id;
        $old_image = $request->old_image;
        $brand = Brand::findOrFail($brandId);

        $brand->brand_name_en = $request->brand_name_en;
        $brand->brand_name_vn = $request->brand_name_vn;
        $brand->brand_slug_en = Str::slug($request->brand_name_en);
        $brand->brand_slug_vn = Str::slug($request->brand_name_vn);

        if($request->file('brand_image')) {
            unlink($old_image);
            $image    = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/'.$name_gen);
            $save_url           = 'upload/brand/'.$name_gen;
            $brand->brand_image = $save_url;
        }

        $brand->save();
        $notification = array(
                'message'    => 'Brand Updated Successfully',
                'alert-type' => 'info',
        );
        return redirect()->route('brand.view')->with($notification);
    }

    public function BrandDelete($id)
    {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);
        $brand->delete();

        $notification = array(
                'message'    => 'Brand Deleted Successfully',
                'alert-type' => 'info',
        );
        return redirect()->route('brand.view')->with($notification);
    }
}
