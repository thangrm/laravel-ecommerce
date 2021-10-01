@extends('admin.master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Add new brand -->
                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">New Brand</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('brand.update')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $brand->id }}">
                                        <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5>Brand Name English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="brand_name_en" class="form-control"
                                                               value="{{ $brand->brand_name_en }}">
                                                        @error('brand_name_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Brand Name Vietnam <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="brand_name_vn" class="form-control"
                                                               value="{{ $brand->brand_name_vn }}">
                                                        @error('brand_name_vn')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Brand Image <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" id="brandImage" name="brand_image"
                                                               class="form-control">
                                                        @error('brand_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <img src="{{ asset($brand->brand_image) }}" id="logoBrand"
                                                         style="max-height: 100px; margin: 10px 2px">
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
                <!-- End add new brand -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
        <script type="text/javascript">
            $(document).ready(function () {
                $('#brandImage').change(function (e) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $('#logoBrand').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>
    </div>
@endsection