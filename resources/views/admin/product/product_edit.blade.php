@extends('admin.master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Edit product -->
                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Edit Product</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-12">
                                    <form id="formProduct" action="{{ route('product.update') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5><label for="productName">Product Name <span class="text-danger">*</span></label></h5>
                                                    <div class="controls">
                                                        <input type="text" id="productName" name="product_name" class="form-control" value="{{ $product->product_name }}">
                                                        @error('product_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <h5><label for="categoryId">Category <span class="text-danger">*</span></label></h5>
                                                            <div class="controls">
                                                                <select class="form-control" name="category_id" id="categoryId">
                                                                    @foreach($categories as $item)
                                                                        <option value="{{ $item->id }}"
                                                                                {{ $product->category_id == $item->id ? 'selected' : '' }}
                                                                        >{{ $item->category_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('category_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <h5><label for="subCategoryId">Sub Category <span class="text-danger">*</span></label></h5>
                                                            <div class="controls">
                                                                <select class="form-control" name="subcategory_id" id="subCategoryId">
                                                                    @foreach($subCategories as $item)
                                                                        <option value="{{ $item->id }}"
                                                                                {{ $product->subcategory_id == $item->id ? 'selected' : '' }}
                                                                        >{{ $item->subcategory_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('subcategory_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <h5><label for="subSubCategoryId">Sub Sub Category <span class="text-danger">*</span></label></h5>
                                                            <div class="controls">
                                                                <select class="form-control" name="subsubcategory_id" id="subSubCategoryId">
                                                                    @foreach($subSubCategories as $item)
                                                                        <option value="{{ $item->id }}"
                                                                                {{ $product->subsubcategory_id == $item->id ? 'selected' : '' }}
                                                                        >{{ $item->subsubcategory_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('subsubcategory_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <h5><label for="brandID">Brand <span class="text-danger">*</span></label></h5>
                                                            <div class="controls">
                                                                <select class="form-control" name="brand_id" id="brandID">
                                                                    @foreach($brands as $item)
                                                                        <option value="{{ $item->id }}"
                                                                                {{ $product->brand_id == $item->id ? 'selected' : '' }}
                                                                        >{{ $item->brand_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('brand_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <h5><label for="productCode">Product Code</label></h5>
                                                            <div class="controls">
                                                                <input type="text" id="productCode" name="product_code" class="form-control" value="{{ $product->product_code }}">
                                                                @error('product_code')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <h5><label for="productQuantity">Product Quantity <span class="text-danger">*</span></label></h5>
                                                            <div class="controls">
                                                                <input type="number" id="productQuantity" name="product_quantity" class="form-control" value="{{ $product->product_quantity }}">
                                                                <small>If there is a product classsification, enter the quantity in the classification</small>
                                                                @error('product_quantity')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <h5><label for="productThumbnail">Product thumbnail <span class="text-danger">*</span></label></h5>
                                                    <div class="controls">
                                                        <input type="file" id="productThumbnail" name="product_thumbnail" class="form-control">
                                                        <div>
                                                            <img id="showImgThumbnail" src="{{ asset($product->product_thumbnail) }}" style="max-height: 100px; margin: 10px 2px">
                                                        </div>
                                                        @error('product_thumbnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <h5><label for="sellingPrice">Price <span class="text-danger">*</span></label></h5>
                                                            <div class="controls">
                                                                <input type="number" id="sellingPrice" name="selling_price" class="form-control" value="{{ $product->selling_price }}">
                                                                @error('selling_price')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <h5><label for="discountPrice">Discount Price</label></h5>
                                                            <div class="controls">
                                                                <input type="number" id="discountPrice" name="discount_price" class="form-control" value="{{ $product->discount_price }}">
                                                                @error('discount_price')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <h5><label for="productTags">Product Tags</label></h5>
                                                            <div class="controls">
                                                                <input type="text" id="productTags" name="product_tags" class="form-control" value="{{ $product->product_tags }}" data-role="tagsinput">
                                                                @error('product_tags')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <h5><label for="productDescription">Description <span class="text-danger">*</span></label></h5>
                                                    <div class="controls">
                                                        <textarea type="file" id="productDescription" name="product_description" class="form-control" style="height: 150px">{{ $product->description }}</textarea>
                                                        @error('product_description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="checkbox" name="hot_deals" id="hotDeals" class="filled-in" {{ $product->hot_deals ? 'checked' : '' }}>
                                                            <label for="hotDeals">Hot deals</label>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="checkbox" name="special_offer" id="specialOffer" class="filled-in" {{ $product->special_offer ? 'checked' : '' }}>
                                                            <label for="specialOffer">Special Offer</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="checkbox" name="featured" id="featured" class="filled-in" {{ $product->featured ? 'checked' : '' }}>
                                                            <label for="featured">Featured</label>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="checkbox" name="special_deals" id="specialDeals" class="filled-in" {{ $product->special_deals ? 'checked' : '' }}>
                                                            <label for="specialDeals">Special Deals</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-xs-right text-right">
                                            <button type="submit" class="btn btn-rounded btn-primary">Update Product</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Product Image</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-xs-right text-left mb-10">
                                                    <input type="file" id="myImageInput" hidden/>
                                                    <button class="btn btn-rounded btn-primary" onclick="document.getElementById('myImageInput').click()">Add Image</button>
                                                </div>

                                                <div id="showProductImg">
                                                    @foreach($productImage as $item)
                                                        <div style="display: inline-block; padding: 5px;">
                                                            <img style="width: 150px; height: 150px;" src="{{ asset($item->photo_name) }}">
                                                            <div class="text-center pt-5">
                                                                <a href="{{ route('product.image.delete',$item->id) }}" class="btn btn-danger" onclick="deleteProductImage(event)">Delete</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Product Classification</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-12">
                                    <form id="formClassification" action="{{ route('product.classification.update') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    @error('classification')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="box">
                                                        <div class="box-body no-padding">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover">
                                                                    <tbody id="tableClassification">
                                                                    <tr class="text-center">
                                                                        <th>Classification</th>
                                                                        <th class="w-150">Quantity</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                    @foreach($classifications as $item)
                                                                    <tr>
                                                                        <td><input type="text" name="classification[{{$item->id}}][name]" class="form-control" value="{{$item->name}}"></td>
                                                                        <td><input type="number" name="classification[{{$item->id}}][quantity]" class="form-control" value="{{$item->quantity}}"></td>
                                                                        <td class="text-center">
                                                                            <button type="button" onclick="deleteRow(this)" class="btn">
                                                                                <i class="fa fa-close"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <div class="text-center">
                                                                    <button type="button" onclick="newRow(this)" class="btn">Add a new row</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.box-body -->
                                                    </div>
                                                    <!-- /.box -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-xs-right text-right">
                                            <button type="submit" class="btn btn-rounded btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                        </div>
                    </div>
                </div>
                <!-- End edit product -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script>
        let classificationIndex = 0;
        $('#formProduct').on('keyup keypress', function(e) {
            let keyCode = e.keyCode || e.which;
            if (keyCode === 13 && e.target.type == "text") {
                e.preventDefault();
                return false;
            }
        });

        // event table classification
        function deleteRow(btn) {
            let row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        function newRow(btn) {
            classificationIndex++;
            let html = ' <tr> ' +
                '<td><input type="text" name="classification['+'new-'+classificationIndex+'][name]" class="form-control"></td>' +
                '<td><input type="number" name="classification['+'new-'+classificationIndex+'][quantity]" class="form-control"></td>' +
                '<td class="text-center"> ' +
                '<button type="button" onclick="deleteRow(this)" class="btn"> ' +
                '<i class="fa fa-close"></i> ' +
                '</button> ' +
                '</td> ' +
                '</tr>'
            document.getElementById("tableClassification").insertAdjacentHTML('beforeend',html)
        }


        function deleteProductImage(e){
            e.preventDefault();
            let link = $(e.target).attr("href");
            $.ajax({
                url: link,
                type: "GET",
                datatype: "json",
                success: function (data){
                    data = JSON.parse(data)
                    if(data['cod'] == 200){
                        toastr.info(data['message']);
                        $(e.target).parent().parent().remove();
                    }
                }
            });
        }

        $(document).ready(function (){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // render image
            $('#productThumbnail').change(function (e){
                let reader = new FileReader();
                reader.onload = function (e){
                    $('#showImgThumbnail').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

            // ajax category

            $('#categoryId').on('change', function (){
                let category_id = $(this).val();
                if(category_id){
                    $.ajax({
                        url: "{{ url('/category/sub/ajax') }}/"+category_id,
                        type: "GET",
                        datatype: "json",
                        success: function (data){
                            data = JSON.parse(data)
                            let selectSubCategories = $('#subCategoryId');
                            selectSubCategories.empty();
                            selectSubCategories.append('<option value="" disabled selected hidden>Select Sub Category</option>');
                            $.each(data, function(key, value){
                                selectSubCategories.append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                            });

                            let selectSubSubCategories = $('#subSubCategoryId');
                            selectSubSubCategories.empty();
                            selectSubSubCategories.append('<option value="" disabled selected hidden>Select Sub Sub Category</option>');
                        }
                    });
                }
            });

            $('#subCategoryId').on('change', function (){
                let subCategory_id = $(this).val();
                if(subCategory_id){
                    $.ajax({
                        url: "{{ url('/category/sub/sub/ajax') }}/"+subCategory_id,
                        type: "GET",
                        datatype: "json",
                        success: function (data){
                            data = JSON.parse(data)
                            let selectSubSubCategories = $('#subSubCategoryId');
                            selectSubSubCategories.empty();
                            selectSubSubCategories.append('<option value="" disabled selected hidden>Select Sub Sub Category</option>');
                            $.each(data, function(key, value){
                                selectSubSubCategories.append('<option value="'+value.id+'">'+value.subsubcategory_name+'</option>');
                            });
                        }
                    });
                }
            });

            // ajax product image

            $('#myImageInput').change(function (e){
                let formData = new FormData();
                formData.append( 'product_id', {{ $product->id }});
                formData.append( 'product_image', $('#myImageInput')[0].files[0]);

                $.ajax({
                    url: '{{ route('product.image.store') }}',
                    type: "POST",
                    datatype: "json",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data){
                        data = JSON.parse(data)
                        let reader = new FileReader();
                        reader.onload = function (e){
                            let linkDelete = '{{ url('product/image/delete') }}' + '/' +data['id'];
                            let html = '<div style="display: inline-block; padding: 5px">' +
                                '<img style="width: 150px; height: 150px;" src="' + e.target.result + '"> ' +
                                '<div class="text-center pt-5"> ' +
                                '<a href="'+linkDelete+'" class="btn btn-danger" onclick="deleteProductImage(event)">Delete</a>'+
                                '</div>'+
                                '</div>';
                            $('#showProductImg').append(html);
                        }
                        reader.readAsDataURL(e.target.files['0']);
                        toastr.success('Product image has been successfully added');
                    }
                });

            });
        });

    </script>
@endsection
