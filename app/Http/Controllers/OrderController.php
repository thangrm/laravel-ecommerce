<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductClassification;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'user_id' => Auth::id(),
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
                'price' => $cart->price,
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

    public function PendingOrders(){
        $orders = Order::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.order.view',compact(['orders']));
    }

    public function ConfirmedOrders(){
        $orders = Order::where('status',2)->orderBy('id','DESC')->get();
        return view('admin.order.view',compact(['orders']));
    }

    public function ShippedOrders(){
        $orders = Order::where('status',3)->orderBy('id','DESC')->get();
        return view('admin.order.view',compact(['orders']));
    }

    public function DeliveredOrders(){
        $orders = Order::where('status',4)->orderBy('id','DESC')->get();
        return view('admin.order.view',compact(['orders']));
    }

    public function CancelOrders(){
        $orders = Order::where('status',5)->orderBy('id','DESC')->get();
        return view('admin.order.view',compact(['orders']));
    }

    public function DetailOrder($orderId){
        $order = Order::findOrFail($orderId);
        $province = DB::table('provinces')->where('id',$order->province_id)->first();
        $district = DB::table('districts')->where('id',$order->district_id)->first();
        $ward = DB::table('wards')->where('id',$order->ward_id)->first();
        $grandTotal = 0;
        foreach ($order->detail as $item){
            $grandTotal += $item->price * $item->quantity;
        }
        return view('admin.order.detail',compact(['order','province','district','ward','grandTotal']));
    }

    public function UpdateStatusOrder(Request $request){
        $request->validate([
              'orderId' => 'required',
              'status' => 'required',
        ]);

        $order = Order::findOrFail($request->orderId);
        $order->status = $request->status;
        $order->save();
        return response()->json([
                'success' => 'Order status has been updated',
                'status' => $order->status,
        ]);
    }
}