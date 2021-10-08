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
        $categories = Category::orderBy('category_name','ASC')->get();
        $subCategories = SubCategory::latest()->get();
        return view('admin.category.sub_view', compact(['categories','subCategories']));
    }

    public function SubCategoryStore(Request $request)
    {
        $request->validate([
                'category_id'   => 'required',
                'subCategory_name' => 'required',
        ], [
                'category_id.required'   => 'Choose category ID',
                'subCategory_name.required' => 'Enter sub category name',
        ]);

        SubCategory::insert([
                'category_id'   => $request->category_id,
                'subCategory_name' => $request->subCategory_name,
                'subCategory_slug' => Str::slug($request->subCategory_name),
        ]);

        $notification = array(
                'message'    => 'Sub Category Inserted Successfully',
                'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function SubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name','ASC')->get();
        $subCategory = SubCategory::findOrFail($id);
        return view('admin.category.sub_edit', compact(['categories','subCategory']));
    }

    public function SubCategoryUpdate(Request  $request)
    {
        $subCategoryId = $request->id;
        $subCategory = SubCategory::findOrFail($subCategoryId);

        $subCategory->category_id = $request->category_id;
        $subCategory->subcategory_name = $request->subcategory_name;
        $subCategory->subcategory_slug = Str::slug($request->subcategory_name);

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
        $subCategories = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subCategories);
    }

    /*
     * THAT FOR SUB - SUB CATEGORY
     */

    public function SubSubCategoryView()
    {
        $categories = Category::orderBy('category_name','ASC')->get();
        $subCategories = SubCategory::orderBy('subcategory_name','ASC')->get();
        $subSubCategories = SubSubCategory::latest()->get();
        return view('admin.category.sub_sub_view', compact(['categories','subCategories','subSubCategories']));
    }

    public function SubSubCategoryStore(Request $request)
    {
        $request->validate([
                'category_id'   => 'required',
                'subcategory_id'   => 'required',
                'subSubCategory_name' => 'required',
        ], [
                'category_id.required'   => 'Choose category ID',
                'subcategory_id.required'   => 'Choose sub category ID',
                'subSubCategory_name.required' => 'Enter sub category name english',
        ]);

        SubSubCategory::insert([
                'subcategory_id'   => $request->subcategory_id,
                'subsubcategory_name' => $request->subSubCategory_name,
                'subsubcategory_slug' => Str::slug($request->subSubCategory_name),
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

        $categories = Category::orderBy('category_name','ASC')->get();
        $subCategories = $subCategories = SubCategory::where('category_id', $categoryID)->orderBy('subcategory_name', 'ASC')->get();
        return view('admin.category.sub_sub_edit', compact(['categories','subCategories','subSubCategory','categoryID']));
    }

    public function SubSubCategoryUpdate(Request  $request)
    {
        $subSubCategory = SubSubCategory::findOrFail($request->id);
        $subSubCategory->subcategory_id = $request->subcategory_id;
        $subSubCategory->subsubcategory_name = $request->subSubCategory_name;
        $subSubCategory->subsubcategory_slug = Str::slug($request->subSubcategory_name);

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

    public function GetSubSubCategory($subCategory_id)
    {
        $subSubCategories = SubSubCategory::where('subcategory_id', $subCategory_id)->orderBy('subsubcategory_name', 'ASC')->get();
        return json_encode($subSubCategories);
    }
}
