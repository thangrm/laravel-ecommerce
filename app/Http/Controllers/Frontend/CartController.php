<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductClassification;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        $product = Product::findOrFail($id);
        $classification = null;
        $max = $product->product_quantity;
        if($request->classification != null) {
            $classification = ProductClassification::find($request->classification);
            $max = $classification->quantity;
        }

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
                        'classification' => $classification,
                        'max' => $max,
                ],
        ]);

        return response()->json(['success' => 'Successfully Added on your cart']);
    }

    public function MyCart(){
        return view('frontend.cart.cart_view');
    }

    public function  GetCartProduct(){
        $carts = Cart::content();
        foreach ($carts as $cart){
            if($cart->qty > intval($cart->options->max)){
                Cart::update($cart->rowId, $cart->options->max);
            }
        }

        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    }

    public function  RemoveCartProduct($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully Remove From Cart']);
    }

    public function  UpdateProductQuantity(Request $request){
        Cart::update($request->rowId, $request->qty);
        return response()->json(['success' => 'Successfully Update Quantity']);
    }

    public function Checkout(){
        if(Auth::check()){
            if(Cart::total()>0){
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                $provinces = DB::table('provinces')->orderBy('name')->get();

                return  view('frontend.cart.checkout',
                        compact(['cartQty','cartTotal','provinces']));
            }else{
                $notification = array(
                        'message'    => 'Shopping now',
                        'alert-type' => 'error',
                );
            }
            return redirect()->route('index')->with($notification);
        }else{
            $notification = array(
                    'message'    => 'You need to login first',
                    'alert-type' => 'error',
            );
            return redirect()->route('login')->with($notification);
        }
    }
}
