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
            'discount_price' => 'required',
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
            'brand_id' => $request->subsubcategory_id,
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_thumbnail' => $save_url,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'description' => $request->product_description,
            'hot_deals' => isset($request->hot_deals) ? 1 : null,
            'featured' => isset($request->featured) ? 1 : null,
            'special_offer' => isset($request->special_offer) ? 1 : null,
            'special_deals' => isset($request->special_deals) ? 1 : null,
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
        if(is_array($classification)){
            foreach ($classification as $item){
                if($item['name'] == null || $item['quantity'] == null)
                    continue;
                ProductClassification::create([
                    'product_id'=>$idProduct,
                    'name'=>$item['name'],
                    'quantity'=>$item['quantity'],
                ]);
            }

        }

        $notification = array(
            'message'    => 'Product Inserted Successfully',
            'alert-type' => 'success',
        );
        return view('admin.index', compact(['notification']));
    }
}
