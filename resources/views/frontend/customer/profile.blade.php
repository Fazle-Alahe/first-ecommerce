@extends('frontend.master')

@section('content')
    
<!-- start wpo-page-title -->
<section class="wpo-page-title">
    <h2 class="d-none">Hide</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="product.html">Customer Profile</a></li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<div class="container">
    <div class="row py-5">
        <div class="col-lg-3">
            <div class="card text-center pt-2">
                @if (Auth::guard('customer')->user()->photo == null)
                    <img width="70" class="m-auto" src="{{Avatar::create(Auth::guard('customer')->user()->fname.' '.Auth::guard('customer')->user()->lname)->toBase64()}}">
                @else
                    <img width="70" class="m-auto" src="{{asset('uploads/customer/')}}/{{Auth::guard('customer')->user()->photo}}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{Auth::guard('customer')->user()->fname.' '.Auth::guard('customer')->user()->lname}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item py-3 bg-light"><a href="" class="text-dark">Profile</a></li>
                    <li class="list-group-item py-3 bg-light"><a href="" class="text-dark">My Order</a></li>
                    <li class="list-group-item py-3 bg-light"><a href="" class="text-dark"> My Wishlist</a></li>
                    <li class="list-group-item py-3 bg-light"><a href="{{route('customer.logout')}}" class="text-dark">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h3>Update Customer Information</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('customer.profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="fname" value="{{Auth::guard('customer')->user()->fname}}">
                                    @error('fname')
                                        <strong class="text-danger">First Name is required.</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" value="{{Auth::guard('customer')->user()->lname}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input disabled type="text" class="form-control" value="{{Auth::guard('customer')->user()->email}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{Auth::guard('customer')->user()->phone}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Zip</label>
                                    <input type="number" class="form-control" name="zip" value="{{Auth::guard('customer')->user()->zip}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{Auth::guard('customer')->user()->address}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image">
                                    <img src="{{asset('uploads/customer/')}}/{{Auth::guard('customer')->user()->image}}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 text-center mt-1">
                                    <button class="btn btn-primary" type="submit">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection