<div class="text-center">
    <img class="card-img-top m-20"
         src="{{ !empty($user->profile_photo_path)? asset('upload/user_images/'.$user->profile_photo_path) : 'https://ui-avatars.com/api/?name='.$user->name.'&background=0D8ABC&color=fff' }}"
         alt="avatar" id="showAvatar" height="50px" width="50px" style="border-radius: 50%; margin: 20px 10px 20px 0px">

    <p>{{ $user->name }}</p>
</div>
<ul>
    <a href="{{ route('index') }}" class="btn btn-primary btn-sm btn-block">Home</a>
    <a href="{{ route('order.list') }}" class="btn btn-primary btn-sm btn-block">Order</a>
    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile</a>
    <a href="{{ route('user.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
</ul>