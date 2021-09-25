@extends('admin.master')
@section('admin')
    <div class="box box-inverse bg-img" data-overlay="2">
        <div class="box-body text-center pb-50">
            <a href="#">
                <img class="avatar avatar-xxl avatar-bordered" src="../images/avatar/5.jpg" alt="">
            </a>
            <h4 class="mt-2 mb-0"><a class="hover-primary text-white" href="#">Roben Parkar</a></h4>
            <span><i class="fa fa-map-marker w-20"></i> Miami</span>
        </div>

        <ul class="box-body flexbox flex-justified text-center" data-overlay="4">
            <li>
                <span class="opacity-60">Followers</span><br>
                <span class="font-size-20">8.6K</span>
            </li>
            <li>
                <span class="opacity-60">Following</span><br>
                <span class="font-size-20">8457</span>
            </li>
            <li>
                <span class="opacity-60">Tweets</span><br>
                <span class="font-size-20">2154</span>
            </li>
        </ul>
    </div>
@endsection
