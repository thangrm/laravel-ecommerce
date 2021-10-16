<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductClassification;
use App\Models\ProductImg;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->brand;
        $product->subSubCategory;
        $product->classification;
        return json_encode($product);
    }

    public function addProduct()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->get();
        return view('admin.product.product_add', compact(['categories','brands']));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'brand_id' => 'required',
            'product_quantity' => 'required',
            'product_thumbnail' => 'required',
            'selling_price' => 'required',
            'product_description' => 'required',
        ]);

        // validate classification
        $classification = $request->classification;
        if(is_array($classification)){
            foreach ($classification as $item){
                if($item['name'] == null && $item['quantity'] != null){
                    return Redirect::back()
                        ->withErrors(['classification' => 'The classification name field is required.']);
                }else if($item['name'] != null && $item['quantity'] == null){
                    return Redirect::back()
                        ->withErrors(['classification' => 'The classification quantity field is required.']);
                }
            }
        }


        // Storage Product Image
        $image = $request->file('product_thumbnail');
        $name_gen = $image->getClientOriginalName().hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(450,450)->save('upload/products/'.$name_gen);
        $save_url = 'upload/products/'.$name_gen;

        $product = (Product::create([
            'product_name' => $request->product_name,
            'product_slug' => Str::slug($request->product_name),
            'subsubcategory_id' => $request->subsubcategory_id,
            'brand_id' => $request->brand_id,
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_thumbnail' => $save_url,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'product_tags' => $request->product_tags,
            'description' => $request->product_description,
            'hot_deals' => isset($request->hot_deals) ? 1 : 0,
            'featured' => isset($request->featured) ? 1 : 0,
            'special_offer' => isset($request->special_offer) ? 1 : 0,
            'special_deals' => isset($request->special_deals) ? 1 : 0,
        ]));
        $idProduct = $product->id;

        // storage multi image
        if($request->hasFile('product_image'))
        {
            foreach($request->file('product_image') as $img)
            {
                $name_gen = $img->getClientOriginalName().hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(450,450)->save('upload/products/'.$name_gen);
                $urlMulti = 'upload/products/'.$name_gen;
                ProductImg::create([
                    'product_id'=>$idProduct,
                    'photo_name'=>$urlMulti,
                ]);
            }
        }

        // storage classification
        $totalQuantity = 0;
        $checkHasClassification = false;
        if(is_array($classification)){
            foreach ($classification as $item){
                if($item['name'] == null || $item['quantity'] == null)
                    continue;
                ProductClassification::create([
                    'product_id'=>$idProduct,
                    'name'=>$item['name'],
                    'quantity'=>$item['quantity'],
                ]);
                $checkHasClassification = true;
                $totalQuantity += intval($item['quantity']);
            }
        }

        if($checkHasClassification){
            $product->product_quantity = $totalQuantity;
            $product->save();
        }

        $notification = array(
            'message'    => 'Product Inserted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('product.manage')->with($notification);
    }

    public function updateProduct(Request $request)
    {
        $request->validate([
                'product_name' => 'required',
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'subsubcategory_id' => 'required',
                'brand_id' => 'required',
                'product_quantity' => 'required',
                'selling_price' => 'required',
                'product_description' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);
        $product->product_name = $request->product_name;
        $product->product_slug = Str::slug($request->product_name);
        $product->subsubcategory_id = $request->subsubcategory_id;
        $product->brand_id = $request->brand_id;
        $product->product_code = $request->product_code;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->product_tags = $request->product_tags;
        $product->description = $request->product_description;
        $product->hot_deals = isset($request->hot_deals) ? 1 : 0;
        $product->featured = isset($request->featured) ? 1 : 0;
        $product->special_offer = isset($request->special_offer) ? 1 : 0;
        $product->special_deals = isset($request->special_deals) ? 1 : 0;

        if($request->hasFile('product_thumbnail')){
            $image = $request->file('product_thumbnail');
            $name_gen = $image->getClientOriginalName().hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(450,450)->save('upload/products/'.$name_gen);
            $save_url = 'upload/products/'.$name_gen;
            $product->product_thumbnail = $save_url;
        }

        $countClassification = ProductClassification::where('product_id',$request->product_id)->count();
        if($countClassification == 0)
            $product->product_quantity = $request->product_quantity;

        $product->save();

        $notification = array(
                'message'    => 'Update Successfully',
                'alert-type' => 'info',
        );
        return redirect()->back()->with($notification);
    }

    public function manageProduct(){
        $product = Product::latest()->get();
        return view('admin.product.product_view',compact(['product']));
    }

    public function editProduct($id){
        $product = Product::findOrFail($id);
        $subSubCategory = SubSubCategory::findOrFail($product->subsubcategory_id);
        $subCategoryID = $subSubCategory->subcategory->id;
        $categoryID = $subSubCategory->subcategory->category_id;

        $product->category_id = $categoryID;
        $product->subcategory_id = $subCategoryID;

        $categories = Category::orderBy('category_name','ASC')->get();
        $subCategories = SubCategory::where('category_id', $categoryID)->orderBy('subcategory_name', 'ASC')->get();
        $subSubCategories = SubSubCategory::where('subcategory_id', $subCategoryID)->orderBy('subsubcategory_name', 'ASC')->get();
        $brands = Brand::orderBy('brand_name','ASC')->get();
        $classifications = ProductClassification::where('product_id',$id)->orderBy('name','ASC')->get();
        $productImage = ProductImg::where('product_id',$product->id)->get();

        return view('admin.product.product_edit', compact(['product','categories','subCategories','subSubCategories','brands','classifications','productImage']));
    }

    public function activeProduct($id){
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->save();
        return redirect()->route('product.manage');
    }

    public function inactiveProduct($id){
        $product = Product::findOrFail($id);
        $product->status = 0;
        $product->save();
        return redirect()->route('product.manage');
    }

    public function deleteProduct($id){
        $product = Product::findOrFail($id);
        ProductClassification::where('product_id','=',$product->id)->delete();

        // Unlink image
        $listImg = ProductImg::where('product_id','=',$product->id);
        foreach ($listImg as $item){
            unlink($item->photo_name);
            $item->delete();
        }
        unlink($product->product_thumbnail);

        $product->delete();

        $notification = array(
                'message'    => 'Product Deleted Successfully',
                'alert-type' => 'info',
        );
        return redirect()->route('product.manage')->with($notification);
    }

    //classification
    public function updateClassification(Request $request){
        // validate classification
        $classification = $request->classification;
        if(is_array($classification)){
            foreach ($classification as $item){
                if($item['name'] == null && $item['quantity'] != null){
                    return Redirect::back()
                            ->withErrors(['classification' => 'The classification name field is required.']);
                }else if($item['name'] != null && $item['quantity'] == null){
                    return Redirect::back()
                            ->withErrors(['classification' => 'The classification quantity field is required.']);
                }
            }
        }

        // storage classification
        $productID = $request->product_id;
        $product = Product::findOrFail($productID);
        $totalQuantity = 0;
        ProductClassification::where('product_id',$productID)->delete();
        if(is_array($classification)){
            foreach ($classification as $item){
                if($item['name'] == null || $item['quantity'] == null)
                    continue;
                ProductClassification::create([
                        'product_id'=>$productID,
                        'name'=>$item['name'],
                        'quantity'=>$item['quantity'],
                ]);
                $totalQuantity += intval($item['quantity']);
            }
        }

        $product->product_quantity = $totalQuantity;
        $product->save();
        $notification = array(
                'message'    => 'Update successfully',
                'alert-type' => 'info',
        );
        return redirect()->back()->with($notification);
    }

    public function getClassification($id){
        $classification = ProductClassification::findOrFail($id);
        return json_encode($classification);
    }

    // Product Image
    public function addImage(Request $request)
    {
        if($request->hasFile('product_image'))
        {
            $product_id = $request->product_id;
            $img = $request->file('product_image');
            $name_gen = $img->getClientOriginalName().hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(450,450)->save('upload/products/'.$name_gen);
            $urlMulti = 'upload/products/'.$name_gen;
            $productImage = ProductImg::create([
                    'product_id'=>$product_id,
                    'photo_name'=>$urlMulti,
            ]);
            return json_encode($productImage);
        }
        return 'error';
    }

    public function deleteImage($image_id)
    {
        $image = ProductImg::findOrFail($image_id);
        unlink($image->photo_name);
        $image->delete();
        return json_encode(['cod'=>200,
                            'message'=>'Product image has been successfully deleted']);
    }
}
