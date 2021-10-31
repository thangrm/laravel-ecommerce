@extends('frontend.master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    @include('frontend.profile.sidebar')
                </div> <!-- end col md 2 -->

                <div class="col-md-10" style="margin: 20px 0px 50px 0px">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr style="background: #e2e2e2">
                                <th class="text-center">Date</th>
                                <th class="text-center">Order ID</th>
                                <th class="text-center">Payment</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width: 230px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $item)
                                <tr role="row" class="odd">
                                    <td>{{ date("Y-m-d",strtotime($item->created_at)) }}</td>
                                    <td>{{ sprintf('RM%06d',$item->id) }}</td>
                                    <td>
                                        @if($item->payment_type == 1)
                                            Cash
                                        @elseif($item->payment_type == 2)
                                            Momo
                                        @endif
                                    </td>
                                    <td>{{ number_format($item->total) }}₫</td>
                                    <td>
                                        @if($item->status == 0)
                                            <span class="badge" style="background: #DC3545">unpaid</span>
                                        @elseif($item->status == 1)
                                            <span class="badge" style="background: #007BFF">pending</span>
                                        @elseif($item->status == 2)
                                            <span class="badge" style="background: #7A15F7">confirmed</span>
                                        @elseif($item->status == 3)
                                            <span class="badge" style="background: #475F7B">shipped</span>
                                        @elseif($item->status == 4)
                                            <span class="badge" style="background: #008965">delivered</span>
                                        @elseif($item->status == 5)
                                            <span class="badge" style="background: #DC3545">cancel</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('order.user_detail',$item->id) }}" class="btn btn-info" title="View Order">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        @if($item->status == 0)
                                            <a href="{{ route('order.edit',$item->id) }}" class="btn btn-primary" title="Invoince">
                                                Payment
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-danger" title="Invoince">
                                                <i class="fa fa-download"></i> Invoice
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div> <!-- end col md 8 -->
            </div> <!-- row -->
        </div>
    </div>
@endsection