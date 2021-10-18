@extends('admin.master')
@section('admin')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Order Detail</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><strong>Shipping Detail</strong> box</h4>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Shipping Name: </th>
                                <th> {{ $order->name }} </th>
                            </tr>
                            <tr>
                                <th>Shipping Phone: </th>
                                <th> {{ $order->phone }} </th>
                            </tr>
                            <tr>
                                <th>Shipping Email: </th>
                                <th> {{ $order->email }} </th>
                            </tr>
                            <tr>
                                <th>Shipping Province: </th>
                                <th> {{ $province->name }} </th>
                            </tr>
                            <tr>
                                <th>Shipping District: </th>
                                <th> {{ $district->name }} </th>
                            </tr>
                            <tr>
                                <th>Shipping Ward: </th>
                                <th> {{ $ward->name }} </th>
                            </tr>
                            <tr>
                                <th>Shipping Address: </th>
                                <th> {{ $order->address }} </th>
                            </tr>
                            <tr>
                                <th>Order date: </th>
                                <th> {{ $order->created_at }} </th>
                            </tr>
                        </table>

                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <strong>Order detail :
                                    <span class="text-danger">{{ sprintf('RM%06d',$order->id) }}</span>
                                </strong>
                            </h4>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Order ID: </th>
                                <th><span class="text-danger">{{ sprintf('RM%06d',$order->id) }} </span></th>
                            </tr>
                            <tr>
                                <th>Name: </th>
                                <th> {{ $order->user->name }} </th>
                            </tr>
                            <tr>
                                <th>Note:</th>
                                <th> {{ $order->note }} </th>
                            </tr>
                            <tr>
                                <th>Payment type: </th>
                                <th>
                                    @if($order->payment_type == 1)
                                    Cash
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th>Order Total: </th>
                                <th> {{ number_format($grandTotal) }} ₫ </th>
                            </tr>
                            <tr>
                                <th>Status: </th>
                                <th id="rowStatus">
                                    @if($order->status == 1)
                                        <span class="badge badge-pill badge-primary">pending</span>
                                    @elseif($order->status == 2)
                                        <span class="badge badge-pill badge-info">confirmed</span>
                                    @elseif($order->status == 3)
                                        <span class="badge badge-pill badge-dark">shipped</span>
                                    @elseif($order->status == 4)
                                        <span class="badge badge-pill badge-success">delivered</span>
                                    @elseif($order->status == 5)
                                        <span class="badge badge-pill badge-danger">cancel</span>
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2" id="rowBtn">
                                    @if($order->status == 1)
                                        <button id="confirmOrder" onclick="changeStatus(event)" class="btn btn-block btn-info">Confirm Order</button>
                                    @elseif($order->status == 2)
                                        <button id="confirmOrder" onclick="changeStatus(event)" class="btn btn-block btn-dark">Ship Order</button>
                                    @elseif($order->status == 3)
                                        <button  id="confirmOrder" onclick="changeStatus(event)" class="btn btn-block btn-success">Deliver Order</button>
                                    @endif
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-bordered border-primary">
                        <div class="table-responsive">
                       <table class="table">
                           <thead>
                           <tr>
                               <th style="width: 10%"> Image</th>
                               <th>Product Name</th>
                               <th>Product Code</th>
                               <th>Type</th>
                               <th>Quantity</th>
                               <th>Subtotal</th>
                               <th>Grandtotal</th>
                           </tr>
                           </thead><!-- /thead -->
                           <tbody id="tableMyCart">
                                @foreach($order->detail as $item)
                                   <tr>
                                       <td>
                                           <img src="{{ asset($item->product->product_thumbnail) }}">
                                       </td>
                                       <td>
                                           {{ $item->product->product_name }}
                                       </td>
                                       <td>
                                           {{ $item->product->product_code }}
                                       </td>
                                       <td>
                                           @if($item->classification != null)
                                                {{ $item->classification->name }}
                                           @else
                                                default
                                           @endif
                                       </td>
                                       <td>
                                          {{ $item->quantity }}
                                       </td>
                                       <td class="cart-product-sub-total"><span class="cart-sub-total-price">{{ number_format($item->price) }} ₫</span></td>
                                       <td class="cart-product-grand-total"><span class="cart-grand-total-price">{{ number_format($item->price * $item->quantity) }} ₫</span></td>
                                   </tr>
                                @endforeach
                           </tbody><!-- /tbody -->
                       </table><!-- /table -->
                   </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success m-2',
                cancelButton: 'btn btn-danger m-2'
            },
            buttonsStyling: false
        });
        var statusOrder = {{ $order->status }};

        var changeStatus = function (e){
            let id = {{ $order->id }};
            let newStatus = statusOrder+1;

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Once Confirm, You will not be able to back!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        data: { orderId: id, status: newStatus },
                        url: "{{ route('order.status.update') }}",
                        success: function (data){
                            statusOrder = parseInt(data.status);
                            let rowStatus = "";
                            let rowBtn = "";


                            if(statusOrder == 1) {
                                rowStatus = `<span class="badge badge-pill badge-primary">pending</span>`;
                                rowBtn = `<button id="confirmOrder" onclick="changeStatus(event)" class="btn btn-block btn-info">Confirm Order</button>`;
                            }else if(statusOrder == 2) {
                                rowStatus = `<span class="badge badge-pill badge-info">confirmed</span>`;
                                rowBtn = `<button id="confirmOrder" onclick="changeStatus(event)" class="btn btn-block btn-dark">Ship Order</button>`;
                            }else if(statusOrder == 3) {
                                rowStatus = `<span class="badge badge-pill badge-dark">shipped</span>`;
                                rowBtn = `<button id="confirmOrder" onclick="changeStatus(event)" class="btn btn-block btn-success">Deliver Order</button>`;
                            }else if(statusOrder== 4) {
                                rowStatus = `<span class="badge badge-pill badge-success">delivered</span>`;
                            }else if(statusOrder == 5) {
                                rowStatus = `<span class="badge badge-pill badge-danger">cancel</span>`;
                            }
                            $('#rowStatus').html(rowStatus);
                            $('#rowBtn').html(rowBtn);

                            swalWithBootstrapButtons.fire(
                                'Success!',
                                data.success,
                                'success'
                            )
                        }
                    });

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
        }
    </script>
@endsection
