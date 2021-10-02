<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function CategoryView()
    {
        $categories = Category::latest()->get();

        return view('admin.category.view', compact('categories'));
    }

    public function CategoryStore(Request $request)
    {
        $request->validate([
                'category_name_en' => 'required',
                'category_name_vn' => 'required',
                'category_icon'   => 'required',
        ], [
                'category_name_en.required' => 'Enter category name english',
                'category_name_vn.required' => 'Enter category name vietnam',
                'category_icon.required'   => 'Enter category icon',
        ]);

        Category::insert([
                'category_name_en' => $request->category_name_en,
                'category_name_vn' => $request->category_name_vn,
                'category_slug_en' => Str::slug($request->category_name_en),
                'category_slug_vn' => Str::slug($request->category_name_vn),
                'category_icon'   => $request->category_icon,
        ]);

        $notification = array(
                'message'    => 'Category Inserted Successfully',
                'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function CategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function CategoryUpdate(Request  $request)
    {
        $categoryId = $request->id;
        $category = Category::findOrFail($categoryId);

        $category->category_name_en = $request->category_name_en;
        $category->category_name_vn = $request->category_name_vn;
        $category->category_slug_en = Str::slug($request->category_name_en);
        $category->category_slug_vn = Str::slug($request->category_name_vn);
        $category->category_icon = $request->category_icon;

        $category->save();
        $notification = array(
                'message'    => 'Category Updated Successfully',
                'alert-type' => 'info',
        );
        return redirect()->route('category.view')->with($notification);
    }

    public function CategoryDelete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        $notification = array(
                'message'    => 'Category Deleted Successfully',
                'alert-type' => 'info',
        );
        return redirect()->route('category.view')->with($notification);
    }
}
