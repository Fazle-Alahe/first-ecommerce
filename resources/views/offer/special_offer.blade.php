@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Special Offer 1</h3>
            </div>
            <div class="card-body">
                <form action="{{route('special.offer.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="mb-3">
                        <label for="" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="product_name" value="{{$special_offers->first()->product_name}}">
                        @error('product_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" value="{{$special_offers->first()->price}}">
                        @error('price')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div><div class="mb-3">
                        <label for="" class="form-label">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price" value="{{$special_offers->first()->discount_price}}">
                        @error('discount_price')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img width="200" id="blah" src="{{asset('uploads/offer/')}}/{{$special_offers->first()->image}}" alt="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Special Offer1</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Special Offer 2</h3>
            </div>
            <div class="card-body">
                <form action="{{route('special.offer2.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('success2'))
                        <div class="alert alert-success">{{session('success2')}}</div>
                    @endif
                    <div class="mb-3">
                        <label for="" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="product_name2" value="{{$special_offers2->first()->product_name2}}">
                        @error('product_name2')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price2" value="{{$special_offers2->first()->price2}}">
                        @error('price2')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Discount Price</label>
                        <input type="number" class="form-control" name="discount_price2" value="{{$special_offers2->first()->discount_price2}}">
                        @error('discount_price2')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image2"  onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img width="200" id="blah2" src="{{asset('uploads/offer/')}}/{{$special_offers2->first()->image2}}" alt="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Special Offer2</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection