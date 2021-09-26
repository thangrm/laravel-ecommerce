@extends('frontend.master')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>Login</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Forgot Password -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Reset Password</h4>
                        @if (session('status'))
                            <div style="margin-top: 10px; color: green; font-size: 15px">
                                {{ session('status') }}
                            </div>
                        @else
                            <p class="">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title" for="email">Email Address <span>*</span></label>
                                    <input type="email" id="email" name="email" class="form-control unicase-form-control text-input"  >
                                </div>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
                            </form>
                        @endif
                    </div>
                    <!-- Forgot Password-->
                </div><!-- /.row -->
            </div><!-- /.Forgot Password-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.body.brands')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->

@endsection