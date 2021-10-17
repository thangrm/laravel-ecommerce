@extends('frontend.master')
@section('title')
     My Cart | RM Store
@endsection
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li class='active'>My cart</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row ">
                <div class="shopping-cart">
                    <div class="shopping-cart-table ">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="cart-romove item">Remove</th>
                                    <th class="cart-description item">Image</th>
                                    <th class="cart-product-name item">Product Name</th>
                                    <th class="cart-qty item" style="width:150px">Quantity</th>
                                    <th class="cart-sub-total item">Subtotal</th>
                                    <th class="cart-total last-item">Grandtotal</th>
                                </tr>
                                </thead><!-- /thead -->
                                <tbody id="tableMyCart">

                                </tbody><!-- /tbody -->
                            </table><!-- /table -->
                        </div>
                    </div><!-- /.shopping-cart-table -->

                    <div class="col-md-12 col-sm-12 cart-shopping-total">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Subtotal<span class="inner-left-md" id="subTotalCart"></span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md" id="grandTotalCard"></span>
                                    </div>
                                </th>
                            </tr>
                            </thead><!-- /thead -->
                            <tbody>
                            <tr>
                                <td>
                                    <div class="cart-checkout-btn pull-right">
                                        <a href="{{ route('cart.checkout') }}" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div><!-- /.cart-shopping-total -->
                </div><!-- /.shopping-cart -->
            </div> <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection
@section('script')
    <script type="text/javascript">
        function slugify(string) {
            return string
                .toString()
                .trim()
                .toLowerCase()
                .replace(/\s+/g, "-")
                .replace(/[^\w\-]+/g, "")
                .replace(/\-\-+/g, "-")
                .replace(/^-+/, "")
                .replace(/-+$/, "");
        }

        function getMyCart(){
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: "/cart/product",
                success: function (data){
                    let row = "";
                    let linkProduct = '{{ url('/product/details') }}' + '/';
                    $.each(data.carts, function (key, value){
                        let url = linkProduct+value.id+'/'+slugify(value.name);
                        let type = "default";
                        let max = value.options.max;
                        if(value.options.classification != null){
                            type = value.options.classification.name;
                            max = value.options.classification.quantity;
                        }
                        row += `<tr>
                                    <td class="romove-item"><button title="cancel" class="icon" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-trash-o"></i></button></td>
                                    <td class="cart-image">
                                        <a class="entry-thumbnail" href="${url}">
                                            <img src="${value.options.image}">
                                        </a>
                                    </td>
                                    <td class="cart-product-name-info">
                                        <h4 class='cart-product-description'><a href="${url}">${value.name}</a></h4>
                                        <div class="cart-product-info">
                                            <span class="product-color">Type:<span>${type}</span></span>
                                        </div>
                                    </td>
                                    <td class="cart-product-quantity" style="text-align: left;">
                                        <input onchange="changeQuantity('${value.rowId}', this)" type="number" class="form-control" min="0" max="${max}" value="${value.qty}">
                                        <small>Max: ${max}</small>
                                    </td>
                                    <td class="cart-product-sub-total"><span class="cart-sub-total-price">${value.price.toLocaleString()} ₫</span></td>
                                    <td class="cart-product-grand-total"><span class="cart-grand-total-price">${value.subtotal.toLocaleString()} ₫</span></td>
                                </tr>`;
                    });
                    $('#tableMyCart').html(row);
                    $('#subTotalCart').text( data.cartTotal + ' ₫');
                    $('#grandTotalCard').text( data.cartTotal + ' ₫');
                }
            });
        }
        getMyCart();

        function cartRemove(id){
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: "/cart/remove/"+id,
                success: function (data){
                    toastr.success(data.success);
                    getMyCart();
                    miniCart();
                }
            });
        }

        function changeQuantity(rowId, inputQty){
            let quantity = parseInt(inputQty.value);
            if(quantity < 0){
                inputQty.value = 0;
                return;
            }else if(quantity > inputQty.max){
                inputQty.value = inputQty.max;
                quantity = inputQty.max;
            }

            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "/cart/update/quantity",
                data: {rowId: rowId, qty: quantity},
                success: function (data) {
                    getMyCart();
                    miniCart();
                }
            });
        }
    </script>
@endsection