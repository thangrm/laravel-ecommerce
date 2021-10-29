@extends('frontend.master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    @include('frontend.profile.sidebar')
                </div> <!-- end col md 2 -->

                <div class="col-md-10" style="margin: 20px 0px 50px 0px">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center"><strong>Shipping Detail</strong></h4>
                                </div>
                                <div class="card-body" style="background: #d5d5d5">
                                    <table class="table">
                                        <tr>
                                            <th>Shipping Name: </th>
                                            <td> {{ $order->name }} </td>
                                        </tr>
                                        <tr>
                                            <th>Shipping Phone: </th>
                                            <td> {{ $order->phone }} </td>
                                        </tr>
                                        <tr>
                                            <th>Shipping Email: </th>
                                            <td> {{ $order->email }} </td>
                                        </tr>
                                        <tr>
                                            <th>Shipping Province: </th>
                                            <td> {{ $province->name }} </td>
                                        </tr>
                                        <tr>
                                            <th>Shipping District: </th>
                                            <td> {{ $district->name }} </td>
                                        </tr>
                                        <tr>
                                            <th>Shipping Ward: </th>
                                            <td> {{ $ward->name }} </td>
                                        </tr>
                                        <tr>
                                            <th>Shipping Address: </th>
                                            <td> {{ $order->address }} </td>
                                        </tr>
                                        <tr>
                                            <th>Order date: </th>
                                            <td> {{ $order->created_at }} </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="text-center"><strong>Order detail : <span style="color: red">{{ sprintf('RM%06d',$order->id) }} </strong></span></h4>
                                </div>
                                <div class="card-body" style="background: #d5d5d5">
                                    <table class="table">
                                        <tr>
                                            <th>Note:</th>
                                            <td> {{ $order->note }} </td>
                                        </tr>
                                        @if($order->payment_type == 1)
                                            <tr>
                                                <th>Payment type: </th>
                                                <td>Cash</td>
                                            </tr>
                                        @elseif($order->payment_type == 2)
                                            <tr>
                                                <th>Payment type: </th>
                                                <td>Momo</td>
                                            </tr>
                                            <tr>
                                                <th>Invoice ID: </th>
                                                <td><span style="color: red">{{ $order->invoice_no }} </span></td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <th>Order Total: </th>
                                            <td> {{ number_format($grandTotal) }} ₫ </td>
                                        </tr>
                                        <tr>
                                            <th>Status: </th>
                                            <td id="rowStatus">
                                                @if($order->status == 0)
                                                    <span class="badge" style="background: #DC3545">unpaid</span>
                                                @elseif($order->status == 1)
                                                    <span class="badge" style="background: #007BFF">pending</span>
                                                @elseif($order->status == 2)
                                                    <span class="badge" style="background: #7A15F7">confirmed</span>
                                                @elseif($order->status == 3)
                                                    <span class="badge" style="background: #475F7B">shipped</span>
                                                @elseif($order->status == 4)
                                                    <span class="badge" style="background: #008965">delivered</span>
                                                @elseif($order->status == 5)
                                                    <span class="badge" style="background: #DC3545">cancel</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div>
                                    <table class="table">
                                        <thead>
                                        <tr style="background: #e2e2e2">
                                            <th class="text-center"> Image</th>
                                            <th class="text-center">Product Name</th>
                                            <th class="text-center">Product Code</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">Grandtotal</th>
                                        </tr>
                                        </thead><!-- /thead -->
                                        <tbody id="tableMyCart">
                                        @foreach($order->detail as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset($item->product->product_thumbnail) }}" width="60px">
                                                </td>
                                                <td>
                                                    {{ $item->product->product_name }}
                                                </td>
                                                <td>
                                                    {{ $item->product->product_code }}
                                                </td>
                                                <td>
                                                    @if($item->classification != null)
                                                        {{ $item->classification->name }}
                                                    @else
                                                        default
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="cart-product-sub-total"><span class="cart-sub-total-price">{{ number_format($item->price) }} ₫</span></td>
                                                <td class="cart-product-grand-total"><span class="cart-grand-total-price">{{ number_format($item->price * $item->quantity) }} ₫</span></td>
                                            </tr>
                                        @endforeach
                                        </tbody><!-- /tbody -->
                                    </table><!-- /table -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col md 8 -->
            </div> <!-- row -->
        </div>
    </div>
@endsection