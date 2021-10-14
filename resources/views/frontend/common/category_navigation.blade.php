<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            @foreach($categories as $category)
                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa {{$category->category_icon}}" aria-hidden="true"></i>{{$category->category_name}}</a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                            <div class="row">
                                @foreach($subCategories as $subCategory)
                                    @if($category->id == $subCategory->category_id)
                                        <div class="col-sm-12 col-md-3">
                                            <h2 class="title">{{ $subCategory->subcategory_name }}</h2>
                                            <ul class="links list-unstyled">
                                                @foreach($subSubCategories as $subSubCategory)
                                                    @if($subCategory->id == $subSubCategory->subcategory_id)
                                                        <li><a href="#">{{$subSubCategory->subsubcategory_name}}</a></li>
                                                @endif
                                            @endforeach
                                            <!-- End SubSubCategory foreach -->
                                            </ul>
                                        </div>
                                        <!-- /.col -->
                                @endif
                            @endforeach
                            <!-- End SubCategory foreach -->
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu --> </li>
                <!-- /.menu-item -->
        @endforeach
        <!-- End Category foreach -->
        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
<!-- /.side-menu -->