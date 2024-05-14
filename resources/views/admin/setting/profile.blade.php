@extends('layouts.admin')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profilePic = document.querySelector(".image img");
        const userFile = document.querySelector("#file-path");
        userFile.onchange = function() {
            profilePic.src = URL.createObjectURL(userFile.files[0]);
        }
    });
</script>
@section('admin_content')
<div class="main-content">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile Settings</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body text-center wrapper">
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                                    <div class="image" style="position: relative;">
                                        <img src="{{ asset(str_replace('/write', '', Auth::user()->user_photo)) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;border: 2px solid #ff0000;">
                                        <label for="file-path">
                                            <span class="material-symbols-rounded" style="position: absolute; top: 15%; left: 58%; transform: translate(-50%, -50%); background-color: #fff; border-radius: 50%; padding: 10px;">
                                                <i data-feather="edit"></i>
                                            </span>
                                        </label>
                                        <input type="file" accept="image/jpeg, image/png, image/jpg" id="file-path" class="user-file dropify" name="user_photo" style="display: none;">
                                    </div>
                                    <h5 class="my-3">{{ Auth::user()->name }}</h5>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                            <form role="form" action="{{route('profile.setting.update')}}" method="Post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input required="" class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ Auth::user()->name }}" placeholder="Enter new username">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input required="" class="form-control @error('email') is-invalid @enderror" name="email" type="email" value="{{ Auth::user()->email }}" placeholder="Enter new email">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <form role="form" action="{{route('password.setting.update')}}" method="Post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Current Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div>
                                            <input required="" class="form-control" name="old_password" type="password" placeholder="Enter current password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">New Password</label>
                                        <input required="" class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Enter new password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Confirm Password</label>
                                        <input required="" class="form-control" name="password_confirmation" type="password" placeholder="re-type password">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>

@endsection