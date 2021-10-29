@extends('frontend.master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    @include('frontend.profile.sidebar')
                </div> <!-- end col md 2 -->

                <div class="col-md-2">
                </div> <!-- end col md 2 -->

                <div class="col-md-6" style="margin: 20px 0px 50px 0px">
                    <div style="margin-bottom: 20px">
                        <h3>@yield('title-form')</h3>
                    </div>
                    <div class="card-body">
                       @yield('form')
                    </div>
                </div> <!-- end col md 6 -->
            </div> <!-- row -->
        </div>
    </div>
@endsection