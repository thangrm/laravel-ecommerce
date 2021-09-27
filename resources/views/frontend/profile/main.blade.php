@extends('frontend.master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <img class="card-img-top m-20"
                         src="{{ !empty($user->profile_photo_path)? asset('upload/user_images/'.$user->profile_photo_path) : 'https://ui-avatars.com/api/?name='.$user->name.'&background=0D8ABC&color=fff' }}"
                         alt="avatar" id="showAvatar" height="50px" width="50px" style="border-radius: 50%; margin: 20px 10px 20px 0px">

                    <span>{{ $user->name }}</span>
                    <ul>
                        <a href="/" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile</a>
                        <a href="{{ route('user.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>
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