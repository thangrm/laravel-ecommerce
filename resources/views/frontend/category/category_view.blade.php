@extends('frontend.master')
@section('title')
    {{ $subSubCategory->subcategory_name }} | RM Store
@endsection
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class='active'>{{ $subSubCategory->subcategory_name }}</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row' style="margin-bottom: 20px">
                <div class='col-md-3 sidebar'>
                    <!-- ================================== TOP NAVIGATION ================================== -->
                     @include('frontend.common.category_navigation')
                    <!-- ================================== TOP NAVIGATION : END ================================== -->
                    <div class="sidebar-module-container">
                        <div class="sidebar-filter">
                            <!-- ============================================== PRICE SILDER============================================== -->
{{--                            <div class="sidebar-widget wow fadeInUp">--}}
{{--                                <div class="widget-header">--}}
{{--                                    <h3 class="widget-title">Price Slider</h3>--}}
{{--                                </div>--}}
{{--                                <div class="sidebar-widget-body m-t-10">--}}
{{--                                    <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">100.000 ₫</span> <span class="pull-right">100,000,000 ₫</span> </span>--}}
{{--                                        <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">--}}
{{--                                        <input type="text" class="price-slider" value="" >--}}
{{--                                    </div>--}}
{{--                                    <!-- /.price-range-holder -->--}}
{{--                                    <a href="#" class="lnk btn btn-primary">Show Now</a>--}}
{{--                                </div>--}}
{{--                                <!-- /.sidebar-widget-body -->--}}
{{--                            </div>--}}
{{--                            <!-- /.sidebar-widget -->--}}
                            <!-- ============================================== PRICE SILDER : END ============================================== -->

                            <!-- ============================================== COMPARE============================================== -->
{{--                            <div class="sidebar-widget wow fadeInUp outer-top-vs">--}}
{{--                                <h3 class="section-title">Compare products</h3>--}}
{{--                                <div class="sidebar-widget-body">--}}
{{--                                    <div class="compare-report">--}}
{{--                                        <p>You have no <span>item(s)</span> to compare</p>--}}
{{--                                    </div>--}}
{{--                                    <!-- /.compare-report -->--}}
{{--                                </div>--}}
{{--                                <!-- /.sidebar-widget-body -->--}}
{{--                            </div>--}}
{{--                            <!-- /.sidebar-widget -->--}}
                            <!-- ============================================== COMPARE: END ============================================== -->

                            <div class="home-banner"> <img src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image"> </div>
                        </div>
                        <!-- /.sidebar-filter -->
                    </div>
                    <!-- /.sidebar-module-container -->
                </div>
                <!-- /.sidebar -->
                <div class='col-md-9'>
                    <!-- ========================================== SECTION – HERO ========================================= -->
                    <div class="clearfix filters-container">
                        <div class="row">
                            <div class="col col-sm-6 col-md-2">
                                <div class="filter-tabs">
                                    <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                        <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                                        <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                                    </ul>
                                </div>
                                <!-- /.filter-tabs -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-12 col-md-6">
                                <div class="col col-sm-3 col-md-6 no-padding">
                                    <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                        <div class="fld inline">
                                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li role="presentation"><a href="#">position</a></li>
                                                    <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                                    <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                                    <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /.fld -->
                                    </div>
                                    <!-- /.lbl-cnt -->
                                </div>
                                <!-- /.col -->
                                <div class="col col-sm-3 col-md-6 no-padding">
                                    <div class="lbl-cnt"> <span class="lbl">Show</span>
                                        <div class="fld inline">
                                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li role="presentation"><a href="#">1</a></li>
                                                    <li role="presentation"><a href="#">2</a></li>
                                                    <li role="presentation"><a href="#">3</a></li>
                                                    <li role="presentation"><a href="#">4</a></li>
                                                    <li role="presentation"><a href="#">5</a></li>
                                                    <li role="presentation"><a href="#">6</a></li>
                                                    <li role="presentation"><a href="#">7</a></li>
                                                    <li role="presentation"><a href="#">8</a></li>
                                                    <li role="presentation"><a href="#">9</a></li>
                                                    <li role="presentation"><a href="#">10</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /.fld -->
                                    </div>
                                    <!-- /.lbl-cnt -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-6 col-md-4 text-right">
                                <div class="pagination-container">
                                    <ul class="list-inline list-unstyled">
                                    </ul>
                                    <!-- /.list-inline -->
                                </div>
                                <!-- /.pagination-container --> </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>

                    <!-- ========================================== PRODUCT LIST VIEW ========================================= -->
                    <div class="search-result-container ">
                        <div id="myTabContent" class="tab-content category-list">

                            <!-- =============================== GRID VIEW =================================-->
                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product">
                                    <div class="row">
                                        @foreach($products as $product)
                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="{{ route('product.details',[$product->id, $product->product_slug]) }}">
                                                                <img  src="{{ asset($product->product_thumbnail) }}" alt="{{ $product->product_name }}">
                                                            </a>
                                                        </div>
                                                        <!-- /.image -->

                                                        <div class="tag new"><span>new</span></div>
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="{{ route('product.details',[$product->id, $product->product_slug]) }}">{{ $product->product_name }}</a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>
                                                        @if($product->discount_price != null)
                                                            <div class="product-price"> <span class="price"> {{ number_format($product->discount_price) }} ₫ </span> <span class="price-before-discount">{{ number_format($product->selling_price) }} ₫</span> </div>
                                                        @else
                                                            <div class="product-price"> <span class="price"> {{ number_format($product->selling_price) }} ₫ </span></div>
                                                        @endif

                                                    </div>
                                                    <!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                                </li>
                                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                                <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.action -->
                                                    </div>
                                                    <!-- /.cart -->
                                                </div>
                                                <!-- /.product -->

                                            </div>
                                            <!-- /.products -->
                                        </div>
                                        @endforeach
                                        <!-- /.item -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.category-product -->

                            </div>
                            <!-- /.tab-pane -->
                            <!-- =============================== GRID VIEW: END =================================-->

                            <!-- =============================== LIST VIEW =================================-->
                            <div class="tab-pane "  id="list-container">
                                <div class="category-product">
                                    @foreach($products as $product)
                                    <div class="category-product-inner wow fadeInUp">
                                        <div class="products">
                                            <div class="product-list product">
                                                <div class="row product-list-row">
                                                    <div class="col col-sm-4 col-lg-4">
                                                        <div class="product-image">
                                                            <div class="image"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </div>
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-sm-8 col-lg-8">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="{{ route('product.details',[$product->id, $product->product_slug]) }}">{{ $product->product_name }}</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            @if($product->discount_price != null)
                                                                <div class="product-price"> <span class="price"> {{ number_format($product->discount_price) }} ₫ </span> <span class="price-before-discount">{{ number_format($product->selling_price) }} ₫</span> </div>
                                                            @else
                                                                <div class="product-price"> <span class="price"> {{ number_format($product->selling_price) }} ₫ </span></div>
                                                            @endif
                                                            <!-- /.product-price -->
                                                            <div class="description m-t-10">
                                                                {{ mb_strimwidth($product->description, 0, 197, '...') }}
                                                            </div>
                                                            <div class="cart clearfix animate-effect">
                                                                <div class="action">
                                                                    <ul class="list-unstyled">
                                                                        <li class="add-cart-button btn-group">
                                                                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                                        </li>
                                                                        <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                                        <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- /.action -->
                                                            </div>
                                                            <!-- /.cart -->

                                                        </div>
                                                        <!-- /.product-info -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-list-row -->
                                                <div class="tag new"><span>new</span></div>
                                            </div>
                                            <!-- /.product-list -->
                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    @endforeach
                                    <!-- /.category-product-inner -->
                                </div>
                                <!-- /.category-product -->
                            </div>
                            <!-- /.tab-pane #list-container -->
                            <!-- =============================== LIST VIEW: END =================================-->

                        </div>
                        <!-- /.tab-content -->
                        <div class="clearfix filters-container">
                            <div class="text-right">
                                <div class="pagination-container">
                                    <ul class="list-inline list-unstyled">
                                        {{ $products->links() }}
                                    </ul>
                                    <!-- /.list-inline -->
                                </div>
                                <!-- /.pagination-container --> </div>
                            <!-- /.text-right -->

                        </div>
                        <!-- /.filters-container -->

                    </div>
                    <!-- /.search-result-container -->
                    <!-- ========================================== PRODUCT LIST VIEW: END ========================================= -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL: END ============================================== -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.body-content -->
@endsection