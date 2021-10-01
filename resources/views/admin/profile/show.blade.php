@extends('admin.master')
@section('admin')
    <!-- Edit profile -->
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Admin Profile</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('admin.profile.edit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <h5>Avatar</h5>
                                        <img class="avatar avatar-xxl avatar-bordered mb-10"
                                             src="{{ !empty($admin->profile_photo_path)? asset('upload/admin_images/'.$admin->profile_photo_path) : asset('backend/images/avatar/5.jpg') }}" alt="avatar" id="showAvatar">
                                        <div class="controls">
                                            <input type="file" name="profile_photo_path" class="form-control" id="avatarForm">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Name</h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" required=""
                                                   data-validation-required-message="This field is required"
                                                   aria-invalid="false" value="{{ $admin->name }}">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Email</h5>
                                        <div class="controls">
                                            <input type="email" name="email" class="form-control" required
                                                   data-validation-required-message="This field is required" value="{{ $admin->email }}" >
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs-right text-right">
                                <button type="submit" class="btn btn-rounded btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box profile -->

        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Change Password</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('admin.password') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <h5>Current Password</h5>
                                        <div class="controls">
                                            <input type="password" name="oldpassword" class="form-control" required=""
                                                   data-validation-required-message="This field is required">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>New Password</h5>
                                        <div class="controls">
                                            <input type="password" name="password" class="form-control" required=""
                                                   data-validation-required-message="This field is required">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Repeat Password</h5>
                                        <div class="controls">
                                            <input type="password" name="password_confirmation"
                                                   data-validation-match-match="password" class="form-control"
                                                   required="">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs-right text-right">
                                <button type="submit" class="btn btn-rounded btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box password -->
    </section>
    <script type="text/javascript">
        $(document).ready(function (){
           $('#avatarForm').change(function (e){
               let reader = new FileReader();
               reader.onload = function (e){
                   $('#showAvatar').attr('src', e.target.result);
               }
               reader.readAsDataURL(e.target.files['0']);
           });
        });
    </script>
@endsection
