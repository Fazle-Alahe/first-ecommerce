@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card-body">
                <h4 class="card-title">User Information Update</h4>
                <form class="forms-sample" action="{{route('user.info.update')}}" method="POST">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}">
                        @error('email')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-body">
                <h4 class="card-title">User Password Update</h4>
                <form class="forms-sample" action="{{route('user.password.update')}}" method="POST">
                        @csrf
                        @if (session('pass_success'))
                        <div class="alert alert-success">{{session('pass_success')}}</div>
                        
                        @endif @if (session('wrong'))
                        <div class="alert alert-success">{{session('wrong')}}</div>
                        @endif
                    <div class="form-group">
                        <label for="exampleInputUsername1">Current Password</label>
                        <input type="password" class="form-control" name="current_password">
                        @error('current_password')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Password</label>
                        <input type="password" class="form-control" name="new_password">
                        @error('new_password')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password">
                        @error('confirm_password')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-body">
                <h4 class="card-title">Profile Photo Update</h4>
                <form class="forms-sample" action="{{route('user.photo.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (session('photo_success'))
                        <div class="alert alert-success">{{session('photo_success')}}</div>
                        @endif
                    <div class="form-group">
                        <label for="exampleInputEmail1">Profile Photo</label>
                        <input type="file" class="form-control" name="photo">
                        @error('photo')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="m-2">
                     <img width="50" src="{{asset('uploads/user')}}/{{Auth::user()->photo}}">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection