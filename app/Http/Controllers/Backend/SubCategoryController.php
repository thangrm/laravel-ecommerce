<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function SubCategoryView()
    {
        $categories = Category::orderBy('category_name_vn','ASC')->get();
        $subCategories = SubCategory::latest()->get();
        return view('admin.category.sub_view', compact(['categories','subCategories']));
    }

    public function SubCategoryStore(Request $request)
    {
        $request->validate([
                'category_id'   => 'required',
                'subCategory_name_en' => 'required',
                'subCategory_name_vn' => 'required',
        ], [
                'category_id.required'   => 'Enter Category ID',
                'subCategory_name_en.required' => 'Enter sub category name english',
                'subCategory_name_vn.required' => 'Enter sub category name vietnam',
        ]);

        SubCategory::insert([
                'category_id'   => $request->category_id,
                'subCategory_name_en' => $request->subCategory_name_en,
                'subCategory_name_vn' => $request->subCategory_name_vn,
                'subCategory_slug_en' => Str::slug($request->subCategory_name_en),
                'subCategory_slug_vn' => Str::slug($request->subCategory_name_vn),
        ]);

        $notification = array(
                'message'    => 'Sub Category Inserted Successfully',
                'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function SubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_vn','ASC')->get();
        $subCategory = SubCategory::findOrFail($id);
        return view('admin.category.sub_edit', compact(['categories','subCategory']));
    }

    public function SubCategoryUpdate(Request  $request)
    {
        $subCategoryId = $request->id;
        $subCategory = SubCategory::findOrFail($subCategoryId);

        $subCategory->category_id = $request->category_id;
        $subCategory->subcategory_name_en = $request->subcategory_name_en;
        $subCategory->subcategory_name_vn = $request->subcategory_name_vn;
        $subCategory->subcategory_slug_en = Str::slug($request->subcategory_name_en);
        $subCategory->subcategory_slug_vn = Str::slug($request->subcategory_name_vn);

        $subCategory->save();
        $notification = array(
                'message'    => 'SubCategory Updated Successfully',
                'alert-type' => 'info',
        );
        return redirect()->route('subCategory.view')->with($notification);
    }

    public function SubCategoryDelete($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        $notification = array(
                'message'    => 'SubCategory Deleted Successfully',
                'alert-type' => 'info',
        );
        return redirect()->route('subCategory.view')->with($notification);
    }
}
