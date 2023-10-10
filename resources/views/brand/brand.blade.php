@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Brand List</h3>
                </div>
                @if (session('delete'))
                    <div class="alert alert-danger">{{session('delete')}}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Brand name</th>
                            <th>Logo</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($brands as $sl=> $brand)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$brand->brand_name}}</td>
                                <td>
                                    <img src="{{asset('uploads/brand/')}}/{{$brand->logo}}" alt="Brand-logo">
                                </td>
                                <td>
                                    <a href="{{route('brand.edit', $brand->id)}}" class="btn btn-primary btn-icon">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="{{route('brand.delete', $brand->id)}}" class="btn btn-danger btn-icon del_btn">
                                        <i data-feather="trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Brand</h4>
                </div>
                <div class="card-body">      
                    <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (session('exist'))
                            <div class="alert alert-warning">{{session('exist')}}</div>
                        @endif 
                        @if (session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Brand Name</label>
                            <input type="text" name="brand_name" class="form-control">
                            @error('brand_name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @error('logo')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
