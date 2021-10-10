@extends('admin.master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Add new category -->
                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Add Product</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-12">
                                    <form id="formProduct" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5><label for="productName">Product Name <span class="text-danger">*</span></label></h5>
                                                    <div class="controls">
                                                        <input type="text" id="productName" name="product_name" class="form-control" value="{{ old('product_name') }}">
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
                                                                    <option value="" disabled selected hidden>Select Category</option>
                                                                    @foreach($categories as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
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
                                                                    <option value="" disabled selected hidden>Select Sub Category</option>
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
                                                                    <option value="" disabled selected hidden>Select Sub Sub Category</option>
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
                                                                    <option value="" disabled selected hidden>Select Brand</option>
                                                                    @foreach($brands as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
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
                                                                <input type="text" id="productCode" name="product_code" class="form-control" value="{{ old('product_code') }}">
                                                                @error('product_code')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <h5><label for="productQuantity">Product Quantity <span class="text-danger">*</span></label></h5>
                                                            <div class="controls">
                                                                <input type="number" id="productQuantity" name="product_quantity" class="form-control" value="{{ old('product_quantity') }}">
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
                                                            <img id="showImgThumbnail" style="max-height: 100px; margin: 10px 2px">
                                                        </div>
                                                        @error('product_thumbnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5><label for="productImage">Product Image</label></h5>
                                                    <div class="controls">
                                                        <input type="file" id="productImage" name="product_image[]" class="form-control" multiple>
                                                        <div id="showProductImg" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <h5><label for="sellingPrice">Price <span class="text-danger">*</span></label></h5>
                                                            <div class="controls">
                                                                <input type="number" id="sellingPrice" name="selling_price" class="form-control" value="{{ old('selling_price') }}">
                                                                @error('selling_price')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <h5><label for="discountPrice">Discount Price<span class="text-danger">*</span></label></h5>
                                                            <div class="controls">
                                                                <input type="number" id="discountPrice" name="discount_price" class="form-control" value="{{ old('discount_price') }}">
                                                                @error('discount_price')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <h5><label for="productTags">Product Tags</label></h5>
                                                            <div class="controls">
                                                                <input type="text" id="productTags" name="product_tags" class="form-control" value="{{old('product_tags')}}" data-role="tagsinput">
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
                                                        <textarea type="file" id="productDescription" name="product_description" class="form-control" style="height: 150px"></textarea>
                                                        @error('product_description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="checkbox" name="hot_deals" id="hotDeals" class="filled-in">
                                                            <label for="hotDeals">Hot deals</label>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="checkbox" name="special_offer" id="specialOffer" class="filled-in">
                                                            <label for="specialOffer">Special Offer</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="checkbox" name="featured" id="featured" class="filled-in">
                                                            <label for="featured">Featured</label>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="checkbox" name="special_deals" id="specialDeals" class="filled-in">
                                                            <label for="specialDeals">Special Deals</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group mt-50">
                                                    <h5><label for="tableClass">Product Classification</label></h5>
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
                                                                        <tr>
                                                                            <td><input type="text" name="classification[0][name]" class="form-control"></td>
                                                                            <td><input type="number" name="classification[0][quantity]" class="form-control"></td>
                                                                            <td class="text-center">
                                                                                <button type="button" onclick="deleteRow(this)" class="btn">
                                                                                    <i class="fa fa-close"></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
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
                                            <button type="submit" class="btn btn-rounded btn-primary">Add New</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <!-- End add new category -->
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
            console.log(row);
            row.parentNode.removeChild(row);
        }

        function newRow(btn) {
            classificationIndex++;
            let html = ' <tr> ' +
                '<td><input type="text" name="classification['+classificationIndex+'][name]" class="form-control"></td>' +
                '<td><input type="number" name="classification['+classificationIndex+'][quantity]" class="form-control"></td>' +
                '<td class="text-center"> ' +
                '<button type="button" onclick="deleteRow(this)" class="btn"> ' +
                '<i class="fa fa-close"></i> ' +
                '</button> ' +
                '</td> ' +
                '</tr>'
            document.getElementById("tableClassification").insertAdjacentHTML('beforeend',html)
        }

        $(document).ready(function (){
            // render image
            function imageIsLoaded(e) {
                $('#showProductImg').append('<img style="max-height: 100px; margin: 10px 2px" src=' + e.target.result + '>');
            };


            $('#productThumbnail').change(function (e){
                let reader = new FileReader();
                reader.onload = function (e){
                    $('#showImgThumbnail').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

            $('#productImage').change(function (e){
                $('#showProductImg').empty();
                if (this.files && this.files[0]) {
                    for (let i = 0; i < this.files.length; i++) {
                        let reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[i]);
                    }
                }
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
        });

    </script>
@endsection
