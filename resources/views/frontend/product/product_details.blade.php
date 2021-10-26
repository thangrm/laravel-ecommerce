@extends('frontend.master')
@section('title')
    {{ $product->product_name }} | Product details
@endsection
@section('content')
    <!-- ===== ======== HEADER : END ============================================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li class='active'>{{ $product->product_name }}</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">
                        <div class="home-banner outer-top-n">
                            <img src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                        </div>


                        <!-- ============================================== HOT DEALS ============================================== -->
                        @include('frontend.common.hot_deals')
                        <!-- ============================================== HOT DEALS: END ============================================== -->

                        <!-- ============================================== NEWSLETTER ============================================== -->

                        <!-- ============================================== NEWSLETTER: END ============================================== -->

                        <!-- ============================================== Testimonials============================================== -->

                        <!-- ============================================== Testimonials: END ============================================== -->


                    </div>
                </div><!-- /.sidebar -->
                <div class='col-md-9'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">

                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">
                                        @foreach ($multiImage as $img)
                                            <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                                <a data-lightbox="image-1" data-title="Gallery"
                                                    href="{{ asset($img->photo_name) }}">
                                                    <img class="img-responsive" alt=""
                                                        src="{{ asset($img->photo_name) }}"
                                                        data-echo="{{ asset($img->photo_name) }}" />
                                                </a>
                                            </div><!-- /.single-product-gallery-item -->
                                        @endforeach
                                    </div><!-- /.single-product-slider -->


                                    <div class="single-product-gallery-thumbs gallery-thumbs">

                                        <div id="owl-single-product-thumbnails">
                                            @foreach ($multiImage as $img)
                                                <div class="item">
                                                    <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                        data-slide="1" href="#slide{{ $img->id }}">
                                                        <img class="img-responsive" width="85" alt=""
                                                            src="{{ asset($img->photo_name) }}"
                                                            data-echo="{{ asset($img->photo_name) }}" />
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div><!-- /#owl-single-product-thumbnails -->


                                    </div><!-- /.gallery-thumbs -->

                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name">{{ $product->product_name }}</h1>

                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">(13 Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.rating-reviews -->

                                    <div class="description-container m-t-20">
                                        {{ mb_strimwidth($product->description, 0, 197, '...') }}
                                    </div><!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    @if ($product->discount_price == null)
                                                        <span
                                                            class="price">{{ number_format($product->selling_price) }}
                                                            ₫</span>
                                                    @else
                                                        <span class="price">{{ number_format($product->discount_price) }} ₫</span>
                                                        <span class="price-strike">{{ number_format($product->selling_price) }} ₫ </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                        title="Wishlist" href="#">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                        title="Add to Compare" href="#">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                        title="E-mail" href="#">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    @if(count($classifications) > 0)
                                                    <label class="info-title control-label">Choose <span>*</span></label>
                                                    <select id="classificationSelect"
                                                        class="form-control">
                                                        <option value="" hidden>--Select options--</option>
                                                        @foreach ($classifications as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <small id="errorClassification" class="text-danger"></small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">In stock :
                                                        <span id="quantityClassification">{{ $product->product_quantity }} </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->

                                    <div class="quantity-container info-container">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label for="productQuantity" style="margin-top: 15%;">Quantity:</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input id="productQuantity" type="number" class="form-control" value="1" min="0" style="padding: 0px 5px;">
                                            </div>

                                            <div class="col-sm-7">
                                                <button onclick="addToCartProduct({{ $product->id }})"class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                            </div>

                                        </div><!-- /.row -->
                                        <small id="errorQuantity" class="text-danger"></small>
                                    </div><!-- /.quantity-container -->


                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
{{--                                    <li><a data-toggle="tab" href="#review">REVIEW</a></li>--}}
{{--                                    <li><a data-toggle="tab" href="#tags">TAGS</a></li>--}}
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">
                                                {{ $product->description }}
                                            </p>
                                        </div>
                                    </div><!-- /.tab-pane -->

{{--                                    <div id="review" class="tab-pane">--}}
{{--                                        <div class="product-tab">--}}

{{--                                            <div class="product-reviews">--}}
{{--                                                <h4 class="title">Customer Reviews</h4>--}}

{{--                                                <div class="reviews">--}}
{{--                                                    <div class="review">--}}
{{--                                                        <div class="review-title"><span class="summary">We love--}}
{{--                                                                this product</span><span class="date"><i--}}
{{--                                                                    class="fa fa-calendar"></i><span>1 days--}}
{{--                                                                    ago</span></span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="text">"Lorem ipsum dolor sit amet,--}}
{{--                                                            consectetur--}}
{{--                                                            adipiscing elit.Aliquam suscipit."--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                </div><!-- /.reviews -->--}}
{{--                                            </div><!-- /.product-reviews -->--}}


{{--                                            <div class="product-add-review">--}}
{{--                                                <h4 class="title">Write your own review</h4>--}}
{{--                                                <div class="review-table">--}}
{{--                                                    <div class="table-responsive">--}}
{{--                                                        <table class="table">--}}
{{--                                                            <thead>--}}
{{--                                                                <tr>--}}
{{--                                                                    <th class="cell-label">&nbsp;</th>--}}
{{--                                                                    <th>1 star</th>--}}
{{--                                                                    <th>2 stars</th>--}}
{{--                                                                    <th>3 stars</th>--}}
{{--                                                                    <th>4 stars</th>--}}
{{--                                                                    <th>5 stars</th>--}}
{{--                                                                </tr>--}}
{{--                                                            </thead>--}}
{{--                                                            <tbody>--}}
{{--                                                                <tr>--}}
{{--                                                                    <td class="cell-label">Quality</td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="1"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="2"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="3"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="4"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="5"></td>--}}
{{--                                                                </tr>--}}
{{--                                                                <tr>--}}
{{--                                                                    <td class="cell-label">Price</td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="1"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="2"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="3"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="4"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="5"></td>--}}
{{--                                                                </tr>--}}
{{--                                                                <tr>--}}
{{--                                                                    <td class="cell-label">Value</td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="1"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="2"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="3"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="4"></td>--}}
{{--                                                                    <td><input type="radio" name="quality"--}}
{{--                                                                            class="radio" value="5"></td>--}}
{{--                                                                </tr>--}}
{{--                                                            </tbody>--}}
{{--                                                        </table><!-- /.table .table-bordered -->--}}
{{--                                                    </div><!-- /.table-responsive -->--}}
{{--                                                </div><!-- /.review-table -->--}}

{{--                                                <div class="review-form">--}}
{{--                                                    <div class="form-container">--}}
{{--                                                        <form role="form" class="cnt-form">--}}

{{--                                                            <div class="row">--}}
{{--                                                                <div class="col-sm-6">--}}
{{--                                                                    <div class="form-group">--}}
{{--                                                                        <label for="exampleInputName">Your Name <span--}}
{{--                                                                                class="astk">*</span></label>--}}
{{--                                                                        <input type="text" class="form-control txt"--}}
{{--                                                                            id="exampleInputName" placeholder="">--}}
{{--                                                                    </div><!-- /.form-group -->--}}
{{--                                                                    <div class="form-group">--}}
{{--                                                                        <label for="exampleInputSummary">Summary <span--}}
{{--                                                                                class="astk">*</span></label>--}}
{{--                                                                        <input type="text" class="form-control txt"--}}
{{--                                                                            id="exampleInputSummary" placeholder="">--}}
{{--                                                                    </div><!-- /.form-group -->--}}
{{--                                                                </div>--}}

{{--                                                                <div class="col-md-6">--}}
{{--                                                                    <div class="form-group">--}}
{{--                                                                        <label for="exampleInputReview">Review <span--}}
{{--                                                                                class="astk">*</span></label>--}}
{{--                                                                        <textarea class="form-control txt txt-review"--}}
{{--                                                                            id="exampleInputReview" rows="4"--}}
{{--                                                                            placeholder=""></textarea>--}}
{{--                                                                    </div><!-- /.form-group -->--}}
{{--                                                                </div>--}}
{{--                                                            </div><!-- /.row -->--}}

{{--                                                            <div class="action text-right">--}}
{{--                                                                <button class="btn btn-primary btn-upper">SUBMIT--}}
{{--                                                                    REVIEW--}}
{{--                                                                </button>--}}
{{--                                                            </div><!-- /.action -->--}}

{{--                                                        </form><!-- /.cnt-form -->--}}
{{--                                                    </div><!-- /.form-container -->--}}
{{--                                                </div><!-- /.review-form -->--}}

{{--                                            </div><!-- /.product-add-review -->--}}

{{--                                        </div><!-- /.product-tab -->--}}
{{--                                    </div><!-- /.tab-pane -->--}}

{{--                                    <div id="tags" class="tab-pane">--}}
{{--                                        <div class="product-tag">--}}

{{--                                            <h4 class="title">Product Tags</h4>--}}
{{--                                            <form role="form" class="form-inline form-cnt">--}}
{{--                                                <div class="form-container">--}}

{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="exampleInputTag">Add Your Tags: </label>--}}
{{--                                                        <input type="email" id="exampleInputTag" class="form-control txt">--}}


{{--                                                    </div>--}}

{{--                                                    <button class="btn btn-upper btn-primary" type="submit">ADD TAGS--}}
{{--                                                    </button>--}}
{{--                                                </div><!-- /.form-container -->--}}
{{--                                            </form><!-- /.form-cnt -->--}}

{{--                                            <form role="form" class="form-inline form-cnt">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>&nbsp;</label>--}}
{{--                                                    <span class="text col-md-offset-3">Use spaces to separate tags. Use--}}
{{--                                                        single quotes (') for phrases.</span>--}}
{{--                                                </div>--}}
{{--                                            </form><!-- /.form-cnt -->--}}

{{--                                        </div><!-- /.product-tab -->--}}
{{--                                    </div><!-- /.tab-pane -->--}}

                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div>
                    <!-- /.product-tabs -->

                    <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">upsell products</h3>
                        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

                            @foreach($specialDeals as $item)
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <div class="image"> <img src="{{ asset($item->product_thumbnail) }}" alt=""> </div>
                                            </div><!-- /.image -->

                                            <div class="tag sale"><span>sale</span></div>
                                        </div><!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="{{ route('product.details',[$item->id, $item->product_slug]) }}">{{ $item->product_name }}</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>

                                            <div class="product-price">
                                                @if($item->discount_price != null)
                                                    <div class="product-price"> <span class="price"> {{ number_format($item->discount_price) }} ₫ </span> <span class="price-before-discount">{{ number_format($item->selling_price) }} ₫</span> </div>
                                                @else
                                                    <div class="product-price"> <span class="price"> {{ number_format($item->selling_price) }} ₫ </span></div>
                                                @endif

                                            </div><!-- /.product-price -->

                                        </div><!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="modal" data-target="#productModal" onclick="productView({{$item->id}})">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                    </li>

                                                    <li class="lnk wishlist">
                                                        <a class="add-to-cart" href="#" title="Wishlist">
                                                            <i class="icon fa fa-heart"></i>
                                                        </a>
                                                    </li>

                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="#" title="Compare">
                                                            <i class="fa fa-signal"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div><!-- /.action -->
                                        </div><!-- /.cart -->
                                    </div><!-- /.product -->

                                </div><!-- /.products -->
                            </div>
                            <!-- /.item -->
                            @endforeach

                        </div><!-- /.home-owl-carousel -->
                    </section><!-- /.section -->
                    <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        @if(count($classifications) > 0)
            var hasClassification = true;
        @else
            var hasClassification = false;
        @endif

        var inStockPD = {{ $product->product_quantity }};
        $('#productQuantity').on('input',function (){
            let qty = parseInt($('#productQuantity').val());
            if( qty > parseInt(inStockPD)){
                $('#productQuantity').val(inStockPD);
            }else if(qty < 0){
                $('#productQuantity').val(1);
            }
        });

        $('#classificationSelect').on('change',function (e){
            let id = $('#classificationSelect').val();
            $.ajax({
                url: '{{ url('ajax/classification') }}'+'/'+id,
                type: "GET",
                success: function (data){
                    data = JSON.parse(data)
                    $('#quantityClassification').html(data.quantity);
                    inStockPD = data.quantity;
                    $('#productQuantity').val(1);
                }
            });
        });

        function addToCartProduct(id){
            let quantity = $('#productQuantity').val();
            if(quantity == ""){
                $('#errorQuantity').text('Enter quantity');
                return;
            }else if(parseInt(quantity) > parseInt(inStockPD)){
                $('#errorQuantity').text('Not enough in stock');
                return;
            }
            else{
                $('#errorQuantity').text('');
            }
            let data;
            if(hasClassification){
                let classification = $('#classificationSelect option:selected').val();
                if(classification == ""){
                    $('#errorClassification').text('Choose type');
                    return;
                }else{
                    $('#errorClassification').text('');
                }
                data = { quantity: quantity, classification: classification }
            }else{
                data = { quantity: quantity}
            }

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: data,
                url: "/cart/store/" + id,
                success: function (data){
                    toastr.success(data.success);
                    miniCart();
                }
            });
        }
    </script>
@endsection