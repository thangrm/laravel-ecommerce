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
                            <h4 class="box-title">Update Sub->SubCategory</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('subSubCategory.update')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $subSubCategory->id }}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5>Category <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select class="form-control" name="category_id" id="categoryId">
                                                            @foreach($categories as $item)
                                                                <option value="{{ $item->id }}"
                                                                {{ $categoryID == $item->id ? 'selected' : '' }}
                                                                >{{ $item->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Sub Category<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select class="form-control" name="subcategory_id" id="subCategoryId">
                                                            @foreach($subCategories as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $subSubCategory->subcategory_id == $item->id ? 'selected' : '' }}
                                                                >{{ $item->subcategory_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('subcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Sub Category Name <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="subSubCategory_name" class="form-control"
                                                               value="{{ $subSubCategory->subsubcategory_name }}" required >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="text-xs-right text-right">
                                                        <button type="submit" class="btn btn-rounded btn-primary">
                                                            Update
                                                        </button>
                                                    </div>
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
                <!-- End add new category -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function (){
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
                        }
                    });
                }
            });
        });
    </script>
@endsection