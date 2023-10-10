@extends('layouts.admin')
@section('content')
    
<div class="col-lg-6 m-auto">
    <div class="card">
        <div class="card-header">
            <h4>Edit Brand</h4>
        </div>
        <div class="card-body">
            <form class="forms-sample" action="{{route('brand.update', $brands->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <div class="form-group">
                    <label for="exampleInputUsername1">Brand Name</label>
                    <input type="text" class="form-control" name="brand_name" value="{{$brands->brand_name}}">
                    @error('brand_name')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Logo</label>
                    <input type="file" class="form-control" name="logo">
                    @error('logo')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <img width="100" src="{{asset('uploads/brand/')}}/{{$brands->logo}}" alt="">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary mr-2">Update Brand</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection