@extends('layouts.admin')
@section('content')
    
<div class="col-lg-6 m-auto">
    <div class="card">
        <div class="card-header">
            <h4>Edit Subcategory</h4>
        </div>
        <div class="card-body">
            <form class="forms-sample" action="{{route('subcategory.update', $subcategories->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <div class="mb-3">
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option {{$subcategories->category_id == $category->id?'selected':' '}} value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <strong class="text-danger">Select a category</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Subcategory Name</label>
                    <input type="text" class="form-control" name="subcategory_name" value="{{$subcategories->subcategory_name}}">
                    @error('subcategory_name')
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
                    <img width="50" src="{{asset('uploads/subcategory/')}}/{{$subcategories->icon}}" alt="">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary mr-2">Update Subcategory</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection