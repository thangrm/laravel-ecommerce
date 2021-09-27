@extends('frontend.profile.main')
@section('title-form')
    My profile
@endsection
@section('form')
<form method="POST" action="{{ route('user.profile.edit') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label class="info-title" for="email">Email Address <span>*</span></label>
        <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
        @error('email')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label class="info-title" for="name">Name <span>*</span></label>
        <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label class="info-title" for="phone">Phone Number <span>*</span></label>
        <input type="text" id="phone" name="phone" class="form-control" pattern="\+?[0-9]{8,}" value="{{ $user->phone }}">
        @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label class="info-title" for="profile_photo_path">Avatar <span>*</span></label>
        <input type="file" id="profile_photo_path" name="profile_photo_path" class="form-control" >
    </div>
    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Save</button>
</form>
@endsection