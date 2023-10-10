@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <form action="{{route('checked.delete')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3>Categories</h3>
                    </div>
                    @if (session('soft_delete'))
                        <div class="alert alert-success">{{session('soft_delete')}}</div>
                    @endif
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="chkSelectAll">Check All
                                            <i class="input-frame"></i>
                                        </label>
                                    </div>
                                </th>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Icon</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($categories as $sl=>$category)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="chkDel" name="category_id[]" value="{{$category->id}}">
                                            <i class="input-frame"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>{{$sl+1}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>
                                    <img src="{{asset('uploads/category')}}/{{$category->icon}}">
                                </td>
                                <td>
                                    <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary btn-icon">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="{{route('category.soft.delete',$category->id)}}" class="btn btn-danger btn-icon">
                                        <i data-feather="trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-danger">Delete Checked</button>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Category</h4>
                </div>
                <div class="card-body">
                    <form class="forms-sample" action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputUsername1">Category Name</label>
                            <input type="text" class="form-control" name="category_name">
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
                            <button type="submit" class="btn btn-primary mr-2">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $("#chkSelectAll").on('click', function(){
            this.checked ? $(".chkDel").prop("checked", true) : $(".chkDel").prop("checked", false);
        })
    </script>
@endsection