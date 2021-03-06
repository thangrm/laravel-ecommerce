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
                            <h4 class="box-title">Update Sub Category</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('subCategory.update')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $subCategory->id }}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5>Category ID<span class="text-danger">*</span></h5>
                                                    <select class="form-control" name="category_id" id="categoryId">
                                                        @foreach($categories as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if($item->id == $subCategory->category_id)
                                                                    selected
                                                                @endif
                                                            >
                                                                {{ $item->category_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Sub Category Name <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="subcategory_name" class="form-control"
                                                               value="{{ $subCategory->subcategory_name }}" required >
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