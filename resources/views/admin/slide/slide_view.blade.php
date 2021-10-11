@extends('admin.master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Manage slide -->
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
                                                <form id="formSlide" action="{{route('slide.store')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="slide_image" id="myImageInput" style="display: none"/>
                                                    <button type="button" class="btn btn-rounded btn-primary" onclick="document.getElementById('myImageInput').click()">Add Slide</button>
                                                </form>
                                            </div>
                                            <div class="box">
                                                <div class="box-body no-padding">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <tbody id="tableImage">
                                                                <tr class="text-center">
                                                                    <th>Slide</th>
                                                                    <th style="width: 30px;">Status</th>
                                                                    <th style="width: 150px;">Action</th>
                                                                </tr>
                                                                @foreach($sliders as $item)
                                                                <tr>
                                                                    <td><img src="{{ asset($item->slide_image) }}"></img></td>
                                                                    <td>
                                                                        @if($item->status == '1')
                                                                            <span class="badge badge-success">Active</span>
                                                                        @else
                                                                            <span class="badge badge-danger">Inactive</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="{{ route('slide.delete',$item->id) }}"  class="btn btn-danger delete-product" title="Delete Product">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>

                                                                        @if($item->status == '1')
                                                                            <a href="{{ route('slide.inactive',$item->id) }}" class="btn btn-danger" title="Inaction Product">
                                                                                <i class="fa fa-arrow-down"></i>
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ route('slide.active',$item->id) }}" class="btn btn-success" title="Action Product">
                                                                                <i class="fa fa-arrow-up"></i>
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
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
                <!-- End manage product -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function (){
            $('#myImageInput').change(function (e){
                $('#formSlide').submit();
            });
        });

    </script>
@endsection
