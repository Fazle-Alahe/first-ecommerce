@extends('layouts.admin')
@section('content')
    
<div class="col-lg-6 m-auto">
    <div class="card">
        <div class="card-header">
            <h4>Edit Category</h4>
        </div>
        <div class="card-body">
            <form class="forms-sample" action="{{route('category.update', $categories->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <div class="form-group">
                    <label for="exampleInputUsername1">Category Name</label>
                    <input type="text" class="form-control" name="category_name" value="{{$categories->category_name}}">
                    @error('category_name')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Icon</label>
                    <input type="file" class="form-control" name="icon">
                    @error('icon')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <img width="50" src="{{asset('uploads/category/')}}/{{$categories->icon}}" alt="">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary mr-2">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection