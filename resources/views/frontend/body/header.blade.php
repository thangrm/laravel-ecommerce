<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="{{ route('order.list') }}"><i class="icon fa fa-clipboard"></i>My orders</a></li>
                        <li><a href="{{ route('myCart') }}"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                        @auth
                            <li><a href="{{ route('user.profile') }}"><i class="icon fa fa-user"></i>User Profile</a></li>
                        @else
                            <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>Login/Register</a></li>
                        @endauth
                    </ul>
                </div>
                <!-- /.cnt-account -->
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo" style="margin-top: -20px;"> <a href="{{ route('index') }}"> <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="logo"> </a> </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= --> </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form>
                            <div class="control-group">
                                <ul class="categories-filter animate-dropdown">
                                    <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown">Categories <b class="caret"></b></a>
                                        <ul class="dropdown-menu" role="menu" >
                                            @php
                                                $categories = \App\Models\Category::orderBy('category_name','ASC')->get();
                                            @endphp
                                            @foreach($categories as $category)
                                            <li role="presentation"><a role="menuitem" tabindex="-1">{{ $category->category_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <input class="search-field" placeholder="Search here..." />
                                <a class="search-button" href="#" ></a> </div>
                        </form>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart">
                        <a href="{{ route('myCart') }}" class="lnk-cart">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                <div class="basket-item-count"><span class="count" id="qtyMiniCart"></span></div>
                                <div class="total-price-basket"><span class="total-price"> <span class="sign"></span><span class="value" id="totalMiniCart"></span> </span> </div>
                            </div>
                        </a>
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="#" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a> </li>

                                @foreach($categories as $category)
                                <li class="dropdown yamm mega-menu"> <a href="#" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $category->category_name }}</a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">
                                                    @php
                                                        /** @var \App\Models\Category $category */
                                                        $subCategories = \App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
                                                    @endphp
                                                    @foreach($subCategories as $subCategory)
                                                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                        <h2 class="title">{{ $subCategory->subcategory_name }}</h2>
                                                        <ul class="links">
                                                            @php
                                                                /** @var \App\Models\SubCategory $subCategory */
                                                                $subSubCategories = \App\Models\SubSubCategory::where('subcategory_id',$subCategory->id)->orderBy('subsubcategory_name','ASC')->get();
                                                            @endphp
                                                            @foreach($subSubCategories as $subSubCategory)
                                                            <li><a href="{{ route('product.view.category',[$subSubCategory->id,$subSubCategory->subsubcategory_slug]) }}">{{$subSubCategory->subsubcategory_name}}</a></li>
                                                            @endforeach
                                                            <!-- End SubSubCategory foreach -->
                                                        </ul>
                                                    </div>
                                                    <!-- /.col -->
                                                    @endforeach
                                                    <!-- End SubCategory foreach -->

                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/top-menu-banner.jpg') }}" alt=""> </div>
                                                    <!-- /.yamm-content -->
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                @endforeach
                                <!-- End Category foreach -->
                                <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
<script>
    function miniCart(){
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: "/cart/product",
            success: function (data) {
                let qty = Object.keys(data.carts).length;
                $('#qtyMiniCart').text(qty);
                $('#totalMiniCart').text( data.cartTotal + ' ₫');
            }
        });
    }
    miniCart();
</script>
