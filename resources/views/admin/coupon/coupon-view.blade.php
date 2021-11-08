@extends('admin.master')
@section('admin')

    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-9">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Coupon List</h4>
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
                                                    <th>Coupon Name</th>
                                                    <th>Coupon Discount</th>
                                                    <th>Coupon Quantity</th>
                                                    <th>Active Date (UTC)</th>
                                                    <th>Expire Date (UTC)</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($coupons as $item)
                                                    @php
                                                        /** @var TYPE_NAME $item */
                                                        $activeDate = date_create($item->coupon_active_date);
                                                        $expireDate = date_create($item->coupon_expire_date);
                                                    @endphp

                                                    <tr role="row" class="odd">
                                                        <td>{{ $item->coupon_name }}</td>
                                                        <td>{{ $item->coupon_discount }}%</td>
                                                        <td>{{ $item->coupon_quantity }}</td>
                                                        <td>{{ date_format($activeDate,'H:i - d/m/Y') }}</td>
                                                        <td>{{ date_format($expireDate,'H:i - d/m/Y') }}</td>
                                                        <td>
                                                            @if((now()->getTimestamp()-$activeDate->getTimestamp()) < 0)
                                                                <span class="badge badge-primary">Inactive</span>
                                                            @elseif((now()->getTimestamp() - $expireDate->getTimestamp()) >= 0)
                                                                <span class="badge badge-danger">expire</span>
                                                            @else
                                                                <span class="badge badge-success">Active</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="" class="btn btn-info" title="Edit Product">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="{{ route('coupon.delete',$item->id) }}"  class="btn btn-danger deleteCoupon" title="Delete Product">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
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
                <div class="col-3">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">New Coupon</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('coupon.store') }}" method="post">
                                        <input type="hidden" name="coupon_active_date" id="activeDateFormat" value="{{ old('coupon_active_date') }}">
                                        <input type="hidden" name="coupon_expire_date" id="expireDateFormat" value="{{ old('coupon_expire_date') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5>Coupon Name <span class="text-danger">*</span> </h5>
                                                    <div class="controls">
                                                        <input type="text" name="coupon_name" class="form-control" value="{{ old('coupon_name') }}">
                                                        @error('coupon_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Coupon Discount (%)<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" step="0.01" name="coupon_discount" class="form-control" value="{{ old('coupon_discount') }}">
                                                        @error('coupon_discount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Coupon Quantity<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" name="coupon_quantity" class="form-control" value="{{ old('coupon_quantity') }}">
                                                        @error('coupon_quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Active Date<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="datetime-local" name="active_date_local" id="activeDateLocal" class="form-control" value="{{ old('active_date_local') }}">
                                                        @error('coupon_active_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Expire Date<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="datetime-local" name="expire_date_local" id="expireDateLocal" class="form-control" value="{{ old('expire_date_local') }}">
                                                        @error('coupon_expire_date')
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
        function LocalTimeToGMT(dateString){
            let date = new Date(dateString);
            let formatDate = date.getUTCFullYear() +"-"+
                padLeadingZeros((date.getUTCMonth()+1),2) +"-" +
                padLeadingZeros(date.getUTCDate(),2) + " " +
                padLeadingZeros(date.getUTCHours(),2) + ":" +
                padLeadingZeros(date.getUTCMinutes(),2) + ":" +
                padLeadingZeros(date.getUTCSeconds(),2);
            return formatDate;
        }

        function padLeadingZeros(num, size) {
            var s = num+"";
            while (s.length < size) s = "0" + s;
            return s;
        }

        $('#activeDateLocal').on('change',function (e) {
            let dateString = $('#activeDateLocal').val();
            $('#activeDateFormat').val(LocalTimeToGMT(dateString));
        })

        $('#expireDateLocal').on('change',function (e) {
            let dateString = $('#expireDateLocal').val();
            $('#expireDateFormat').val(LocalTimeToGMT(dateString));
        })

        $(document).on('click', '.deleteCoupon', function (e){
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
                        'Coupon has been deleted.',
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
