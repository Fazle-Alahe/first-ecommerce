@extends('layouts.admin')
@section('content')
@can('logo_access')
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Logo</h3>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-body">
                <form action="{{route('logo.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control">
                        @error('logo')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        {{-- <img width="100" src="{{asset('uploads/logo/')}}/{{$logo->logo}}" alt=""> --}}
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Logo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<h3 class="secondary">You dont have to access this page</h3>
@endcan
@endsection