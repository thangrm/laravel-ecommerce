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
                    <li class='active'>Checkout</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content">
        <div class="container">
            <div class="checkout-box ">
                <div class="row">
                    <form action="{{ route('order.store') }}" method="post">
                    <div class="col-md-8">
                        <div class="panel-group checkout-steps" id="accordion">
                            <!-- checkout -->
                                @csrf
                                <div class="panel panel-default checkout-step-01">
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <!-- panel-body  -->
                                        <div class="panel-body">
                                            <!-- shipping address -->
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <h3 class="checkout-subtitle"><b>Order Information</b></h3>
                                                    <div class="form-group">
                                                        <label for="shippingName" class="text-secondary" >Shipping Name <span class="text-danger">*</span></label>
                                                        <input id="shippingName" name="shippingName"  type="text" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email <span class="text-danger">*</span></label>
                                                        <input id="email" name="email" type="text" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Phone <span class="text-danger">*</span></label>
                                                        <input id="phone" name="phone" type="text" class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  for="note">Note</label>
                                                        <textarea id="note" name="note" class="form-control" rows="5" cols="50"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-6">
                                                    <h3 class="checkout-subtitle"><b>Shipping Address</b></h3>

                                                    <div class="form-group">
                                                        <label for="selectProvince">City <span class="text-danger">*</span></label>
                                                        <select id="selectProvince" name="selectProvince" class="form-control" required>
                                                            <option value="" hidden>-- Choose Province --</option>
                                                            @foreach($provinces as $province)
                                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="selectDistrict">District <span class="text-danger">*</span></label>
                                                        <select id="selectDistrict" name="selectDistrict" class="form-control" required>
                                                            <option value="" hidden>-- Choose District --</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="selectWard">Ward <span class="text-danger">*</span></label>
                                                        <select id="selectWard" name="selectWard" class="form-control" required>
                                                            <option value="" hidden>-- Choose Ward --</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Address <span class="text-danger">*</span></label>
                                                        <input type="text" id="address" name="address" class="form-control" required>
                                                    </div>

                                                </div>
                                            </div><!-- shipping address: end -->
                                        </div>
                                        <!-- panel-body  -->

                                    </div><!-- row -->
                                </div>
                                <!-- checkout -->

                        </div><!-- /.checkout-steps -->
                    </div>
                    <div class="col-md-4">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Your Checkout</h4>
                                    </div>
                                    <div class="">
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            <li class="list-group-item"><b>Subtotal: </b>{{ $cartTotal }} ₫</li>
                                            <li class="list-group-item"><b>Coupon Discount: </b>0 ₫</li>
                                            <li class="list-group-item"><b>Grand total: </b>{{ $cartTotal }} ₫</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->

                        <!-- payment-type-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Select Payment Type</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <lable for="paymentCash">Cash</lable>
                                            <input type="radio" id="paymentCash" value="1" name="payment_type" required>
                                            <img src="{{ asset('frontend/assets/images/cash.png') }}" style="width: 50px; height: 50px;">
                                        </div>
                                        <div class="col-md-6">
                                            <lable for="paymentMomo">Momo</lable>
                                            <input type="radio" id="paymentMomo" value="2" name="payment_type" required>
                                            <img src="{{ asset('frontend/assets/images/momo.png') }}" style="width: 50px; height: 50px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- payment-type-sidebar -->

                        <div class="row" style="margin: 0px">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Order</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div><!-- /.row -->
            </div><!-- /.checkout-box -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection
@section('script')
    <script>
        $('#selectProvince').on('change',function(){
            let id = $('#selectProvince').val();
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: "/ajax/districts/" + id,
                success: function (data){
                    let html = '<option value="" hidden>-- Choose District --</option>';
                    data.forEach(item => {
                        html += `<option value="${item.id}">${item.name}</option>`
                    });
                    $('#selectDistrict').html(html);
                }
            });
        });

        $('#selectDistrict').on('change',function(){
            let id = $('#selectDistrict').val();
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: "/ajax/wards/" + id,
                success: function (data){
                    let html = '<option value="" hidden>-- Choose Ward --</option>';
                    data.forEach(item => {
                        html += `<option value="${item.id}">${item.name}</option>`
                    });
                    $('#selectWard').html(html);
                }
            });
        });
    </script>
@endsection