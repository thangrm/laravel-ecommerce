<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: DejaVu Sans;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
        .font{
            font-size: 15px;
        }
        .authority {
            /*text-align: center;*/
            float: right
        }
        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }
        .thanks p {
            color: green;;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>
<body>

<table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
        <!-- {{-- <img src="" alt="" width="150"/> --}} -->
            <h2 style="color: green; font-size: 26px;"><strong>RM Store</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
               RM Store
               Email:support@rmstore.com <br>
               Phone: 0999888 <br>
               Thành phố hà nội <br>
            </pre>
        </td>
    </tr>

</table>


<table width="100%" style="background:white; padding:2px;""></table>

<table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
            <p class="font" style="margin-left: 20px;">
                <strong>Name:</strong> {{ $order->name }} <br>
                <strong>Email:</strong> {{ $order->email }} <br>
                <strong>Phone:</strong> {{ $order->phone }} <br>
                @php
                    /** @var TYPE_NAME $order */
                    /** @var TYPE_NAME $ward */
                    /** @var TYPE_NAME $district */
                    /** @var TYPE_NAME $province */
                    $address = sprintf("%s, %s, %s, %s", $order->address, $ward->name, $district->name, $province->name)
                @endphp
                <strong>Address:</strong> {{ $address }} <br>
            </p>
        </td>
        <td>
            <p class="font">
            <h3><span style="color: green;">Order ID:</span> {{ sprintf('RM%06d',$order->id) }}</h3>
            Order Date: {{ date("Y-m-d",strtotime($order->created_at)) }} <br>
            Payment Type :
            @if($order->payment_type == 1)
                Cash
            @elseif($order->payment_type == 2)
                Momo
            @endif
            </span>
            </p>
        </td>
    </tr>
</table>
<br/>
<h3>Products</h3>


<table width="100%">
    <thead style="background-color: green; color:#FFFFFF;">
    <tr class="font">
        <th>Image</th>
        <th>Product Name</th>
        <th>Code</th>
        <th>Type</th>
        <th>Quantity</th>
        <th>Unit Price </th>
        <th>Total </th>
    </tr>
    </thead>
    <tbody>

    @foreach($order->detail as $item)
    <tr class="font">
        <td align="center">
            <img src="{{ public_path($item->product->product_thumbnail) }}" height="60px;" width="60px;" alt="">
        </td>
        <td align="center">{{ $item->product->product_name }}</td>
        <td align="center">{{ $item->product->product_code }}</td>
        <td align="center">
            @if($item->classification != null)
                {{ $item->classification->name }}
            @else
                default
            @endif
        </td>
        <td align="center">{{ $item->quantity }}</td>
        <td align="center">{{ number_format($item->price) }}</td>
        <td align="center">{{ number_format($item->price * $item->quantity) }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
<br>
<table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2><span style="color: green;">Subtotal:</span> {{ number_format($grandTotal) }} ₫</h2>
            <h2><span style="color: green;">Total:</span> {{ number_format($grandTotal) }} ₫</h2>
            {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
        </td>
    </tr>
</table>
<div class="thanks mt-3">
    <p>Thanks For Buying Products..!!</p>
</div>
<div class="authority float-right mt-5">
    <p>-----------------------------------</p>
    <h5>Authority Signature: RM Store</h5>
</div>
</body>
</html>