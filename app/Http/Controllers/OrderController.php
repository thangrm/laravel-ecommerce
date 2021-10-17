<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductClassification;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function store(Request $request){
        $request->validate([
                'shippingName' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'selectProvince' => 'required',
                'selectDistrict' => 'required',
                'selectWard' => 'required',
                'address' => 'required',
        ]);

        $order = Order::create([
           'name' => $request->shippingName,
           'email' => $request->email,
           'phone' => $request->phone,
           'province_id' => $request->selectProvince,
           'district_id' => $request->selectDistrict,
           'ward_id' => $request->selectWard,
           'address' => $request->address,
           'note' => $request->note,
        ]);

        $carts = Cart::content();
        foreach ($carts as $cart){
            $classification_id = null;

            $product = Product::findOrFail($cart->id);
            $product->product_quantity = $product->product_quantity - $cart->qty;

            if($cart->options->classification != null){
                $classification_id = $cart->options->classification->id;
                $productClass = ProductClassification::findOrFail($classification_id);
                $productClass->quantity = $productClass->quantity - $cart->qty;
                $productClass->save();
            }

            $product->save();

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'quantity' => $cart->qty,
                'classification_id' => $classification_id,
            ]);


        }
        Cart::destroy();
        $notification = array(
                'message'    => 'Order Successfully',
                'alert-type' => 'success',
        );
        return redirect()->route('index')->with($notification);
    }
}
