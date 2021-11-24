@php
$prefix = Request::route()->getPrefix();
$nameRouter = Route::current()->getName();

@endphp
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('admin.dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src=" {{ asset('backend/images/logo.png') }}" alt="">
                        <h3><b>RM</b> Admin</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ $nameRouter == 'admin.dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview {{ $prefix == '/brand' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="globe"></i>
                    <span>Brands</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $nameRouter == 'brand.view' ? 'active' : '' }}">
                        <a href="{{ route('brand.view') }}"><i class="ti-more"></i>All Brands</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/category' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="grid"></i>
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $nameRouter == 'category.view' ? 'active' : '' }}">
                        <a href="{{ route('category.view') }}"><i class="ti-more"></i>All Category</a>
                    </li>
                    <li class="{{ $nameRouter == 'subCategory.view' ? 'active' : '' }}">
                        <a href="{{ route('subCategory.view') }}"><i class="ti-more"></i>All Sub Category</a>
                    </li>
                    <li class="{{ $nameRouter == 'subSubCategory.view' ? 'active' : '' }}">
                        <a href="{{ route('subSubCategory.view') }}"><i class="ti-more"></i>All
                            Sub->SubCategory</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/product' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="package"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $nameRouter == 'product.manage' ? 'active' : '' }}">
                        <a href="{{ route('product.manage') }}">
                            <i class="ti-more"></i>Manage Products
                        </a>
                    </li>
                    <li class="{{ $nameRouter == 'product.add' ? 'active' : '' }}">
                        <a href="{{ route('product.add') }}">
                            <i class="ti-more"></i>Add Product
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/coupon' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="tag"></i>
                    <span>Coupons</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $nameRouter == 'coupon.view' ? 'active' : '' }}">
                        <a href="{{ route('coupon.view') }}">
                            <i class="ti-more"></i>All Coupons
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/slide' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="image"></i>
                    <span>Slides</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $nameRouter == 'slide.view' ? 'active' : '' }}">
                        <a href="{{ route('slide.view') }}">
                            <i class="ti-more"></i>Manage Slides
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $prefix == '/order' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="shopping-bag"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $nameRouter == 'order.pending' ? 'active' : '' }}">
                        <a href="{{ route('order.pending') }}">
                            <i class="ti-more"></i>Pending Orders
                        </a>
                    </li>
                    <li class="{{ $nameRouter == 'order.confirmed' ? 'active' : '' }}">
                        <a href="{{ route('order.confirmed') }}">
                            <i class="ti-more"></i>Confirmed Orders
                        </a>
                    </li>
                    <li class="{{ $nameRouter == 'order.shipped' ? 'active' : '' }}">
                        <a href="{{ route('order.shipped') }}">
                            <i class="ti-more"></i>Shipped Orders
                        </a>
                    </li>
                    <li class="{{ $nameRouter == 'order.delivered' ? 'active' : '' }}">
                        <a href="{{ route('order.delivered') }}">
                            <i class="ti-more"></i>Delivered Orders
                        </a>
                    </li>
                    <li class="{{ $nameRouter == 'order.cancel' ? 'active' : '' }}">
                        <a href="{{ route('order.cancel') }}">
                            <i class="ti-more"></i>Cancel Orders
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
