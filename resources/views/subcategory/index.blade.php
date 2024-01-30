@extends('layouts.admin')
@section('content')
@can('subcategory_access')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Subcategory List</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($categories as $category)
                    <div class="col-lg-6">
                        <div class="card-header">
                            <h4>{{$category->category_name}}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Subcategory name</th>
                                    <th>Icon</th>
                                    <th>Action</th>
                                </tr>
                                @forelse (App\Models\Subcategory::where('category_id', $category->id)->get() as $subcategory)
                                    <tr>
                                        <td>{{$subcategory->subcategory_name}}</td>
                                        <td>
                                            <img src="{{asset('uploads/subcategory/')}}/{{$subcategory->icon}}">
                                        </td>
                                        @can('subcategory_action')
                                        <td>
                                            <a href="{{route('subcategory.edit', $subcategory->id)}}" class="btn btn-primary btn-icon">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-icon del_btn" data-link="{{route('subcategory.delete', $subcategory->id)}}">
                                                <i data-feather="trash"></i>
                                            </a>
                                        </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center"><h5>No Subcategory Found</h5></td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @can('subcategory_add')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Add New Subcategory</h4>
            </div>
            <div class="card-body">      
                <form action="{{route('subcategory.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('exist'))
                        <div class="alert alert-warning">{{session('exist')}}</div>
                    @endif
                        @if (session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="mb-3">
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <strong class="text-danger">Select a category</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subcategory Name</label>
                        <input type="text" name="subcategory_name" class="form-control">
                        @error('subcategory_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon</label>
                        <input type="file" name="icon" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Subcategory</button>
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

@section('footer_script')
<script>
    $(".del_btn").on('click', function(){
    let link =$(this).attr('data-link')

        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href= link
        }
        })
    })
</script>
@if (session('delete'))
 <script>
     Swal.fire(
      'Deleted!',
      '{{session('delete')}}',
      'success'
    )
 </script>

@endif
@endsection
