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
                'category_name' => 'required',
                'category_icon'   => 'required',
        ], [
                'category_name.required' => 'Enter category name',
                'category_icon.required'   => 'Enter category icon',
        ]);

        Category::insert([
                'category_name' => $request->category_name,
                'category_slug' => Str::slug($request->category_name),
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

        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name);
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
