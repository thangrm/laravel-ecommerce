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
                            <h4 class="box-title">Edit Coupon</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('coupon.update') }}" method="post">
                                        <input type="hidden" name="id" value="{{ $coupon->id }}">
                                        <input type="hidden" name="coupon_active_date" id="activeDateFormat"
                                               value="{{ !empty(old('coupon_active_date')) ? old('coupon_active_date') : $coupon->coupon_active_date }}">
                                        <input type="hidden" name="coupon_expire_date" id="expireDateFormat"
                                               value="{{ !empty(old('coupon_expire_date')) ? old('coupon_expire_date') : $coupon->coupon_expire_date }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5>Coupon Name <span class="text-danger">*</span> </h5>
                                                    <div class="controls">
                                                        <input type="text" name="coupon_name" class="form-control"
                                                               value="{{ !empty(old('coupon_name')) ? old('coupon_name') : $coupon->coupon_name }}">
                                                        @error('coupon_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Coupon Discount (%)<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" step="0.01" name="coupon_discount" class="form-control"
                                                            value="{{ !empty(old('coupon_discount')) ? old('coupon_discount') : $coupon->coupon_discount }}">
                                                        @error('coupon_discount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Coupon Quantity<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" name="coupon_quantity" class="form-control"
                                                            value="{{ !empty(old('coupon_quantity')) ? old('coupon_quantity') : $coupon->coupon_quantity }}">
                                                        @error('coupon_quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Active Date<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="datetime-local" name="active_date_local" id="activeDateLocal" class="form-control"
                                                            value="{{ !empty(old('coupon_active_date')) ? old('coupon_active_date') : date("Y-m-d\TH:i:s", strtotime($coupon->coupon_active_date)) }}">
                                                        @error('coupon_active_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Expire Date<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="datetime-local" name="expire_date_local" id="expireDateLocal" class="form-control"
                                                               value="{{ !empty(old('coupon_active_date')) ? old('coupon_active_date') : date("Y-m-d\TH:i:s", strtotime($coupon->coupon_active_date)) }}">
                                                        @error('coupon_expire_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="text-xs-right text-right">
                                            <button type="submit" class="btn btn-rounded btn-primary">Update</button>
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
            let s = num+"";
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

    </script>
@endsection