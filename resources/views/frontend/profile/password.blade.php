@extends('frontend.profile.main')
@section('title-form')
    Change Password
@endsection
@section('form')
<form method="POST" action="{{ route('user.password.change') }}">
    @csrf
    <div class="form-group">
        <label class="info-title" for="oldpassword">Password <span>*</span></label>
        <input type="password" id="oldpassword" name="oldpassword" class="form-control" >
    </div>
    <div class="form-group">
        <label class="info-title" for="password">New Password <span>*</span></label>
        <input type="password" id="password" name="password" class="form-control" >
    </div>
    <div class="form-group">
        <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" >
    </div>
    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Save</button>
</form>
@endsection