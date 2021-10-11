@extends('admin.master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Product List</h4>
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
                                                    <th>Image</th>
                                                    <th>Product Name</th>
                                                    <th>Product Price</th>
                                                    <th>Quantity</th>
                                                    <th>Discount</th>
                                                    <th>Status</th>
                                                    <th style="width: 150px;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($product as $item)
                                                    <tr role="row" class="odd">
                                                        <td><img src="{{ asset($item->product_thumbnail) }}" style="max-height: 50px;"></td>
                                                        <td>{{ $item->product_name }}</td>
                                                        <td>{{ $item->selling_price }}</td>
                                                        <td>{{ $item->product_quantity }}</td>
                                                        <td>
                                                            <span class="badge badge-danger">
                                                                @if($item->discount_price !== null && $item->selling_price != 0)
                                                                    {{ intval(($item->selling_price - $item->discount_price)/$item->selling_price*100) }}%
                                                                @else
                                                                    No
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @if($item->status == '1')
                                                                <span class="badge badge-success">Active</span>
                                                            @else
                                                                <span class="badge badge-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info" title="Edit Product">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="{{ route('product.delete',$item->id) }}"  class="btn btn-danger delete-product" title="Delete Product">
                                                                <i class="fa fa-trash"></i>
                                                            </a>

                                                            @if($item->status == '1')
                                                                <a href="{{ route('product.inactive',$item->id) }}" class="btn btn-danger" title="Inaction Product">
                                                                    <i class="fa fa-arrow-down"></i>
                                                                </a>
                                                            @else
                                                                <a href="{{ route('product.active',$item->id) }}" class="btn btn-success" title="Action Product">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).on('click', '.delete-product', function (e){
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

