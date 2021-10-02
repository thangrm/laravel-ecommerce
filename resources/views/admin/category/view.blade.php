@extends('admin.master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Category List</h4>
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
                                                        <th>Category Icon</th>
                                                        <th>Category En</th>
                                                        <th>Category Vn</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($categories as $item)
                                                    <tr role="row" class="odd">
                                                        <td><span><i class="{{ $item->category_icon }}"></i></span></td>
                                                        <td >{{ $item->category_name_en }}</td>
                                                        <td >{{ $item->category_name_vn }}</td>
                                                        <td >
                                                            <a href="{{ route('category.edit',$item->id) }}" class="btn btn-info mr-2 p-5">Edit</a>
                                                            <a href="{{ route('category.delete',$item->id) }}" class="btn btn-danger p-5 delete">Delete</a>
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

                <!-- Add new category -->
                <div class="col-4">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">New Category</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5>Category English <span class="text-danger">*</span> </h5>
                                                    <div class="controls">
                                                        <input type="text" name="category_name_en" class="form-control">
                                                        @error('category_name_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Category Vietnam <span class="text-danger">*</span> </h5>
                                                    <div class="controls">
                                                        <input type="text" name="category_name_vn" class="form-control">
                                                        @error('category_name_vn')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Category Icon <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="category_icon" class="form-control">
                                                        @error('category_icon')
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
                <!-- End add new category -->
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
                        'Category has been deleted.',
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
