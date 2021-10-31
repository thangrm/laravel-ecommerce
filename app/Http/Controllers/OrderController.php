<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductClassification;
use App\Models\User;
use App\Providers\MomoServiceProvider;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request){
        $CASH = 1;
        $MOMO = 2;
        $request->validate([
                'shippingName' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'selectProvince' => 'required',
                'selectDistrict' => 'required',
                'selectWard' => 'required',
                'address' => 'required',
                'payment_type' => 'required',
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
                'payment_type' => $request->payment_type,
        ]);

        $carts = Cart::content();
        $total = Cart::total(0,'','');
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

        if($request->payment_type == $MOMO){
            $orderIDMomo = 'MM'.time();
            $order->invoice_no = $orderIDMomo;
            $order->status = 0;
            $order->save();
            $response = MomoServiceProvider::purchase([
                    'ipnUrl' => route('order.momo.confirm'),
                    'redirectUrl' => route('order.momo.redirect'),
                    'orderId' => $orderIDMomo,
                    'amount' => $total,
                    'orderInfo' => 'RM purchase',
                    'requestId' => $orderIDMomo,
                    'extraData' => '',
            ]);
            if($response->successful()){
                return redirect($response->json('payUrl'));
            }else{
                $notification = array(
                        'message'    => 'Please try again later or choose another payment method',
                        'alert-type' => 'info',
                );
                return redirect()->back()->with($notification);
            }
        }
        else if($request->payment_type == $CASH){
            $notification = array(
                    'message'    => 'Order Successfully',
                    'alert-type' => 'success',
            );
            return redirect()->route('index')->with($notification);
        }
    }

    public function update(Request $request){
        $CASH = 1;
        $MOMO = 2;
        $request->validate([
                'id' => 'required',
                'shippingName' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'selectProvince' => 'required',
                'selectDistrict' => 'required',
                'selectWard' => 'required',
                'address' => 'required',
                'payment_type' => 'required',
        ]);
        $order = Order::findOrFail($request->id);
        $order->name = $request->shippingName;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->province_id = $request->selectProvince;
        $order->district_id = $request->selectDistrict;
        $order->ward_id = $request->selectWard;
        $order->address = $request->address;
        $order->note = $request->note;
        $order->payment_type = $request->payment_type;
        $order->save();

        if($request->payment_type == $MOMO){
            $orderIDMomo = 'MM'.time();
            $order->invoice_no = $orderIDMomo;
            $order->status = 0;
            $order->save();
            $grandTotal = 0;
            foreach ($order->detail as $item){
                $grandTotal += $item->price * $item->quantity;
            }

            $response = MomoServiceProvider::purchase([
                    'ipnUrl' => route('order.momo.confirm'),
                    'redirectUrl' => route('order.momo.redirect'),
                    'orderId' => $orderIDMomo,
                    'amount' => strval($grandTotal),
                    'orderInfo' => 'RM purchase',
                    'requestId' => $orderIDMomo,
                    'extraData' => '',
            ]);
            if($response->successful()){
                return redirect($response->json('payUrl'));
            }else{
                $notification = array(
                        'message'    => 'Please try again later or choose another payment method',
                        'alert-type' => 'info',
                );
                return redirect()->back()->with($notification);
            }
        }
        else if($request->payment_type == $CASH){
            $order->status = 1;
            $order->save();
            $notification = array(
                    'message'    => 'Order Successfully',
                    'alert-type' => 'success',
            );
            return redirect()->route('index')->with($notification);
        }
    }

    public function edit($orderId){
        $order = Order::findOrFail($orderId);
        $provinces = DB::table('provinces')->orderBy('name')->get();
        $districts = DB::table('districts')->orderBy('name')
                ->where('province_id',$order->province_id)->get();
        $wards = DB::table('wards')->orderBy('name')
                ->where('district_id',$order->district_id)->get();
        $grandTotal = 0;
        foreach ($order->detail as $item){
            $grandTotal += $item->price * $item->quantity;
        }
        return view('frontend.order.edit',
                compact(['order','provinces','districts','wards','grandTotal']));
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

    public function MyOrders(){
        $id = Auth::user()->id;
        $totalOrders = DB::table('orders')
                ->selectRaw('orders.id as id, sum(price*quantity) as total')
                ->join('order_details','orders.id','=','order_details.order_id')
                ->groupBy('orders.id');

        $orders = DB::table('orders')->joinSub($totalOrders, 'total_orders', function($join){
            $join->on('orders.id','=','total_orders.id');
        })->orderBy('orders.id','desc')->get();

        $user = User::find($id);
        return view('frontend.order.view', compact(['orders','user']));
    }

    public function UserOrderDetail($orderId){
        $order = Order::findOrFail($orderId);
        $province = DB::table('provinces')->where('id',$order->province_id)->first();
        $district = DB::table('districts')->where('id',$order->district_id)->first();
        $ward = DB::table('wards')->where('id',$order->ward_id)->first();
        $grandTotal = 0;
        foreach ($order->detail as $item){
            $grandTotal += $item->price * $item->quantity;
        }
        $user = User::find(Auth::user()->id);

        return view('frontend.order.detail',
                compact(['order','province','district','ward','grandTotal','user']));
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

    /* MOMO */

    public function redirectMomo(Request $request){
        $checkPayment = MomoServiceProvider::completePurchase($request);
        $notification = array(
                'message'    => $checkPayment['message'],
                'alert-type' => 'error',
        );
        if($checkPayment['success']) {
            $order = Order::where('invoice_no', $request->orderId)->first();
            if($order != null){
                $order->paid = true;
                $order->status = 1;
                $order->transaction_id = $request->transId;
                $order->save();
                $notification = array(
                        'message'    => 'Order Successfully',
                        'alert-type' => 'success',
                );
            }else{
                $notification['message'] = 'Invalid invoice code';
            }
        }
        return redirect()->route('index')->with($notification);
    }

    public function confirmMomo(Request $request){
        $order = Order::where('invoice_no', $request->orderId)->first();
        if($order != null){
            $order->paid = true;
            $order->status = 1;
            $order->transaction_id = $request->transId;
            $order->save();
        }
    }

    /* GET ORDER BY STATUS */
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
}
