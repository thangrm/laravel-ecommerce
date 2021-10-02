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
                            <h4 class="box-title">Update Category</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('category.update')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                        <input type="hidden" name="old_image" value="{{ $category->category_image }}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5>Category Name English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="category_name_en" class="form-control"
                                                               value="{{ $category->category_name_en }}">
                                                        @error('category_name_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Category Name Vietnam <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="category_name_vn" class="form-control"
                                                               value="{{ $category->category_name_vn }}">
                                                        @error('category_name_vn')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Category Icon <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="category_icon" class="form-control" value="{{ $category->category_icon }}">
                                                        @error('category_icon')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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