@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <form action="{{route('checked.restore')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3>Trash Categories</h3>
                    </div>
                    @if (session('category_restore'))
                        <div class="alert alert-success">{{session('category_restore')}}</div>
                    @endif
                    @if (session('pDelete'))
                        <div class="alert alert-danger">{{session('pDelete')}}</div>
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
                            @forelse($categories as $sl=>$category)
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
                                    <img src="{{asset('uploads/category')}}/{{$category->icon}}" alt="{{$category->icon}}">
                                </td>
                                <td>
                                    <a title="restore" href=" {{route('category.restore',$category->id)}}" class="btn btn-success btn-icon important">
                                        <i data-feather="rotate-cw"></i>
                                    </a>
                                    <a title="Permanent Delete" href=" {{route('category.permanent.delete',$category->id)}}" class="btn btn-danger btn-icon">
                                        <i data-feather="trash"></i>
                                    </a>
                                </td>
                            </tr>   

                                @empty
                                <tr>
                                    <td colspan="4" class="text-center"><h4>No Trash Category Found</h4></td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" value="1" class="btn btn-success" name="btn">Restore Checked</button>
                    <button type="submit" value="2" class="btn btn-danger" name="btn">Delete Checked</button>
                </div>
            </form>
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