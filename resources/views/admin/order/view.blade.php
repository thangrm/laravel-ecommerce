@extends('admin.master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Order List</h4>
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
                                                    <th>Date</th>
                                                    <th>Order ID</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th style="width: 50px;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $item)
                                                    <tr role="row" class="odd">
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>{{ sprintf('RM%06d',$item->id) }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>
                                                            @if($item->status == 1)
                                                                <span class="badge badge-pill badge-primary">pending</span>
                                                            @elseif($item->status == 2)
                                                                <span class="badge badge-pill badge-info">confirmed</span>
                                                            @elseif($item->status == 3)
                                                                <span class="badge badge-pill badge-dark">shipped</span>
                                                            @elseif($item->status == 4)
                                                                <span class="badge badge-pill badge-success">delivered</span>
                                                            @elseif($item->status == 5)
                                                                <span class="badge badge-pill badge-danger">cancel</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('order.detail',$item->id) }}" class="btn btn-info" title="View Order">
                                                                <i class="fa fa-eye"></i>
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
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
@endsection
