@extends('layouts.admin')
@section('content')
@can('user_access')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>User List</h4>
            </div>
            @if (session('delete'))
            <div class="alert alert-success">{{session('delete')}}</div>
            @endif
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr> 
                    @foreach ($users as $sl=>$user)
                    <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->photo == null)
                            <img width="50" src="{{Avatar::create($user->name)->toBase64()}}" alt="">
                            @else
                              <img width="50" src="{{asset('uploads/user/')}}/{{$user->photo}}">
                            @endif
                        </td>
                        @can('user_delete')  
                        <td>
                            <a href="{{route('user.delete', $user->id)}}" class="btn btn-danger btn-icon">
                                <i data-feather="trash"></i>
                            </a>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @can('user_add')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Add New User</h4>
            </div>
            <div class="card-body">
                <form class="forms-sample" action="{{route('add.user')}}" method="POST">
                    @csrf
                    @if (session('add_success'))
                        <div class="alert alert-success">{{session('add_success')}}</div>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email">
                        @error('email')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div> <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div> <div class="form-group">
                        <label for="exampleInputEmail1">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password">
                        @error('confirm_password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        @if (session('wrong'))
                        <div class="alert alert-success">{{session('wrong')}}</div>
                    @endif
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary mr-2">Add user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>
@else
<h3 class="secondary">You dont have to access this page</h3>
@endcan
@endsection