@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Offer 1</h3>
            </div>
            <div class="card-body">
                <form action="{{route('offer1.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{$offer->first()->title}}">
                        @error('title')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" value="{{$offer->first()->price}}">
                        @error('price')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price" value="{{$offer->first()->discount_price}}">
                        @error('discount_price')
                            <strong class="text-danger">Discount Price field is required.</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img width="200" id="blah" src="{{asset('uploads/offer/')}}/{{$offer->first()->image}}" alt="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" value="{{$offer->first()->date}}">
                        @error('date')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Offer1</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Offer 2</h3>
            </div>
            <div class="card-body">
                <form action="{{route('offer2.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('success2'))
                        <div class="alert alert-success">{{session('success2')}}</div>
                    @endif
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title2" value="{{$offer2->first()->title2}}">
                        @error('title2')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Sub Title</label>
                        <input type="text" class="form-control" name="subtitle" value="{{$offer2->first()->subtitle}}">
                        @error('price')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image2"  onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                       
                        <div class="my-2">
                            <img width="200" id="blah2" src="{{asset('uploads/offer/')}}/{{$offer2->first()->image}}" alt="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Offer2</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection