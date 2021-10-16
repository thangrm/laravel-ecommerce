<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        $product = Product::findOrFail($id);

        if($product->discount_price == NULL){
            $price =  $product->selling_price;
        }else{
            $price =  $product->discount_price;
        }

        Cart::add([
                'id' => $id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $price,
                'weight' => 1,
                'options' => [
                        'image' => $product->product_thumbnail,
                        'classification' => $request->classification,
                ],
        ]);

        return response()->json(['success' => 'Successfully Added on your cart']);
    }
}
