@extends('admin.master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Brand List</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <div id="complex_header_wrapper"
                                     class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="complex_header"
                                                   class="table table-striped table-bordered display dataTable"
                                                   style="width: 100%;" role="grid"
                                                   aria-describedby="complex_header_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Brand Name</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($brands as $item)
                                                    <tr role="row" class="odd">
                                                        <td >{{ $item->brand_name }}</td>
                                                        <td ><img src="{{ asset($item->brand_image) }}" style="max-height: 50px;"></td>
                                                        <td >
                                                            <a href="{{ route('brand.edit',$item->id) }}" class="btn btn-info mr-2 p-5">Edit</a>
                                                            <a href="{{ route('brand.delete',$item->id) }}" class="btn btn-danger p-5 delete">Delete</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.col -->

                <!-- Add new brand -->
                <div class="col-4">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">New Brand</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5>Brand Name <span class="text-danger">*</span> </h5>
                                                    <div class="controls">
                                                        <input type="text" name="brand_name" class="form-control">
                                                        @error('brand_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Brand Image <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" name="brand_image" class="form-control">
                                                        @error('brand_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
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
                <!-- End add new brand -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).on('click', '.delete', function (e){
            e.preventDefault();
            let link = $(this).attr("href");
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success m-2',
                    cancelButton: 'btn btn-danger m-2'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Brand has been deleted.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        '',
                        'error'
                    )
                }
            })
        })

    </script>
@endsection
