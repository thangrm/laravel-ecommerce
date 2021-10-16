<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">HOT DEALS</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
        @foreach($hotDeals as $item)
            <div class="item">
                <div class="products">
                    <div class="hot-deal-wrapper">
                        <div class="image"> <img src="{{ asset($item->product_thumbnail) }}" alt=""> </div>
                        @if($item->discount_price !== null && $item->selling_price != 0)
                            <div class="sale-offer-tag"><span>{{ intval(($item->selling_price - $item->discount_price)/$item->selling_price*100) }}% </br> OFF</span></div>
                        @endif
                        <div class="timing-wrapper">
                            <div class="box-wrapper">
                                <div class="date box"> <span class="key">00</span> <span class="value">DAYS</span> </div>
                            </div>
                            <div class="box-wrapper">
                                <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                            </div>
                            <div class="box-wrapper">
                                <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                            </div>
                            <div class="box-wrapper hidden-md">
                                <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.hot-deal-wrapper -->

                    <div class="product-info text-left m-t-20">
                        <h3 class="name"><a href="{{ route('product.details',[$item->id, $item->product_slug]) }}">{{ $item->product_name }}</a></h3>
                        <div class="rating rateit-small"></div>

                        @if($item->discount_price != null)
                            <div class="product-price"> <span class="price"> {{ number_format($item->discount_price) }} ₫ </span> <span class="price-before-discount">{{ number_format($item->selling_price) }} ₫</span> </div>
                        @else
                            <div class="product-price"> <span class="price"> {{ number_format($item->selling_price) }} ₫ </span></div>
                            <!-- /.product-price -->
                        @endif

                    </div>
                    <!-- /.product-info -->

                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <div class="add-cart-button btn-group">
                                <button class="btn btn-primary icon" data-toggle="modal" data-target="#productModal" onclick="productView({{$item->id}})"> <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                            </div>
                        </div>
                        <!-- /.action -->
                    </div>
                    <!-- /.cart -->
                </div>
            </div>
        @endforeach
    </div>
    <!-- /.sidebar-widget -->
</div>