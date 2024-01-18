@extends('layouts.admin')
@section('content')
<div class="col-lg-6 m-auto">
    <div class="card">
        <div class="card-header">
            <h3>Festival Offer</h3>
        </div>
        <div class="card-body">
            <form action="{{route('festival.offer.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="{{$festival->first()->title}}">
                    @error('title')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Discount (percentage)</label>
                    <input type="number" class="form-control" name="discount" value="{{$festival->first()->discount}}">
                    @error('discount')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Left Image</label>
                    <input type="file" class="form-control" name="left_image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    <div class="my-2">
                        <img width="200" id="blah" src="{{asset('uploads/offer/')}}/{{$festival->first()->left_image}}" alt="">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Right Image</label>
                    <input type="file" class="form-control" name="right_image"  onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                    <div class="my-2">
                        <img width="200" id="blah2" src="{{asset('uploads/offer/')}}/{{$festival->first()->right_image}}" alt="">
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update Festival Offer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection