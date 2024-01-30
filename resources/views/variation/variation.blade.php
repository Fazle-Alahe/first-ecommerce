@extends('layouts.admin')
@section('content')
@can('variation_access')
<div class="row">
    <div class="col-lg-8">
        <div class="card bg-light">
            <div class="card-header">
                <h3>Color List</h3>
            </div>
            @if (session('color_delete'))
                <div class="alert alert-danger">{{session('color_delete')}}</div>
            @endif
            <div class="card-body">
                <table class="table table-bordered">
                    <tr class="text-center">
                        <th>Color Name</th>
                        <th>Color</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($colors as $color)
                        <tr class="text-center">
                            <td>{{$color->color_name}}</td>
                            <td>
                                <i style="display: inline-block; width: 30px; height: 25px; background: {{$color->color_name == 'NA' ? '' : $color->color_code}}; color: {{$color->color_name == 'NA' ? '' : 'transparent'}};">{{$color->color_name == 'NA' ? $color->color_name : 'Color'}}</i>
                            </td>
                            @can('color_action')
                            <td>
                                <a href="{{route('color.delete', $color->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card mt-3">
            <div class="card-header">
                <h3>Size List</h3>
            </div>
            @if (session('size_delete'))
                <div class="alert alert-danger">{{session('size_delete')}}</div>
            @endif
            <div class="card-body">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-lg-6">
                            <div class="card mb-2">
                                <div class="card-header">
                                    <h4>{{$category->category_name}}</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Size Name</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach (App\Models\Size::where('category_id', $category->id)->get() as $size)
                                            <tr>
                                                <td>{{$size->size_name}}</td>
                                                @can('size_action')
                                                <td>
                                                    <a href="{{route('size.delete', $size->id)}}" class="btn btn-danger">Delete</a>
                                                </td>
                                                @endcan
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @can('color_&_size_add')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add Color</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-body">
                <form action="{{route('color.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Color Name</label>
                        <input type="text" class="form-control" name="color_name">
                        @error('color_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Color Code</label>
                        <input type="text" class="form-control" name="color_code">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Color</button>
                    </div>
                </form>
            </div>
        </div> 
        <div class="card mt-3">
            <div class="card-header">
                <h3>Add Size</h3>
            </div>
            @if (session('size_success'))
                <div class="alert alert-success">{{session('size_success')}}</div>
            @endif
            <div class="card-body">
                <form action="{{route('size.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Size Name</label>
                        <input type="text" class="form-control" name="size_name">
                        @error('size_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Size</button>
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