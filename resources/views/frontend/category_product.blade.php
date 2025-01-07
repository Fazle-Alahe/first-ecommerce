@extends('frontend.master')
@section('content')
    
<section class="themart-interestproduct-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="wpo-section-title">
                    {{-- <h2>All Products</h2> --}}
                </div>
            </div>
        </div>
        <div class="product-wrap">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item">
                            <div class="image">
                                <img height="250px" src="{{asset('uploads/product/preview/')}}/{{$product->prev_img}}" alt="">
                                @if ($product->discount)
                                    <div class="tag sale">-{{$product->discount}}%</div>
                                @else
                                    <div class="tag new">New</div>
                                @endif
                            </div>
                            <div class="text">
                                <h2><a href="{{route('product.details',$product->slug)}}" title="{{$product->product_name}}">
                                    @if (strlen($product->product_name) > 20)
                                        {{substr($product->product_name, 0, 20).'...'}}
                                    @else
                                        {{$product->product_name}}
                                    @endif
                                    </a>
                                </h2>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>130</span>
                                </div>
                                <div class="price">
                                    <span class="present-price">&#2547; {{$product->after_discount}}</span>
                                    @if ($product->discount)
                                        <del class="old-price">&#2547; {{$product->product_price}}</del>
                                    @endif
                                </div>
                                <div class="shop-btn">
                                    <a class="theme-btn-s2" href="{{route('product.details',$product->slug)}}">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection