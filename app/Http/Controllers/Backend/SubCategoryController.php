<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
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
                'category_id.required'   => 'Choose category ID',
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

    public function GetSubCategory($category_id)
    {
        $subCategories = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_vn', 'ASC')->get();
        return json_encode($subCategories);
    }
    /*
     * THAT FOR SUB - SUB CATEGORY
     */
    public function SubSubCategoryView()
    {
        $categories = Category::orderBy('category_name_vn','ASC')->get();
        $subCategories = SubCategory::orderBy('subcategory_name_vn','ASC')->get();
        $subSubCategories = SubSubCategory::latest()->get();
        return view('admin.category.sub_sub_view', compact(['categories','subCategories','subSubCategories']));
    }

    public function SubSubCategoryStore(Request $request)
    {
        $request->validate([
                'category_id'   => 'required',
                'subcategory_id'   => 'required',
                'subSubCategory_name_en' => 'required',
                'subSubCategory_name_vn' => 'required',
        ], [
                'category_id.required'   => 'Choose category ID',
                'subcategory_id.required'   => 'Choose sub category ID',
                'subSubCategory_name_en.required' => 'Enter sub category name english',
                'subSubCategory_name_vn.required' => 'Enter sub category name vietnam',
        ]);

        SubSubCategory::insert([
                'subcategory_id'   => $request->subcategory_id,
                'subsubcategory_name_en' => $request->subSubCategory_name_en,
                'subsubcategory_name_vn' => $request->subSubCategory_name_vn,
                'subsubcategory_slug_en' => Str::slug($request->subSubCategory_name_en),
                'subsubcategory_slug_vn' => Str::slug($request->subSubCategory_name_vn),
        ]);

        $notification = array(
                'message'    => 'Sub Category Inserted Successfully',
                'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function SubSubCategoryEdit($id)
    {
        $subSubCategory = SubSubCategory::findOrFail($id);
        $categoryID = $subSubCategory->subcategory->category_id;

        $categories = Category::orderBy('category_name_vn','ASC')->get();
        $subCategories = $subCategories = SubCategory::where('category_id', $categoryID)->orderBy('subcategory_name_vn', 'ASC')->get();
        return view('admin.category.sub_sub_edit', compact(['categories','subCategories','subSubCategory','categoryID']));
    }

    public function SubSubCategoryUpdate(Request  $request)
    {
        $subSubCategory = SubSubCategory::findOrFail($request->id);
        $subSubCategory->subcategory_id = $request->subcategory_id;
        $subSubCategory->subsubcategory_name_en = $request->subSubCategory_name_en;
        $subSubCategory->subsubcategory_name_vn = $request->subSubCategory_name_vn;
        $subSubCategory->subsubcategory_slug_en = Str::slug($request->subSubCategory_name_en);
        $subSubCategory->subsubcategory_slug_vn = Str::slug($request->subSubcategory_name_vn);

        $subSubCategory->save();
        $notification = array(
                'message'    => 'Sub SubCategory Updated Successfully',
                'alert-type' => 'info',
        );
        return redirect()->route('subSubCategory.view')->with($notification);
    }

    public function SubSubCategoryDelete($id)
    {
        $subSubCategory = SubSubCategory::findOrFail($id);
        $subSubCategory->delete();

        $notification = array(
                'message'    => 'Sub SubCategory Deleted Successfully',
                'alert-type' => 'info',
        );
        return redirect()->route('subSubCategory.view')->with($notification);
    }
}
