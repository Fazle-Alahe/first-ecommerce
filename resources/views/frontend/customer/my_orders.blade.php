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
                        <li><a href="product.html">My Orders</a></li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- cart-area start -->
<div class="order-area section-padding">
    <div class="container">
        <div class="form">
            <div class="order-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3>My Orders</h3>
                            </div>
                            <div class="card-body">
                                <form action="https://wpocean.com/html/tf/themart/order">
                                    <table class="table table-striped">
                                        <tr class="text-center">
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Ship To</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ( $orders as $order )
                                            <tr class="text-center">
                                                <td class="images">{{$order->order_id}}</td>
                                                <td class="product">{{$order->created_at->format('d-M-Y')}}</td>
                                                <td class="ptice"></td>
                                                <td class="name"></td>
                                                <td class="">&#2547;{{$order->total}}</td>
                                                <td class="status_c">
                                                    @if ($order->status == 0)
                                                        <span class="bg-secondary abc">Placed</span>
                                                    @elseif ($order->status == 1)
                                                        <span class="bg-primary abc">Processing</span>
                                                    @elseif ($order->status == 2)
                                                        <span class="bg-warning abc">Shipping</span>
                                                    @elseif ($order->status == 3)
                                                        <span class="bg-info abc">Ready for Deliver</span>
                                                    @elseif ($order->status == 4)
                                                        <span class="bg-success abc">Received</span>
                                                    @elseif ($order->status == 5)
                                                        <span class="bg-danger abc">Cancel</span>
                                                    @endif
                                                    
                                                </td>
                                                <td>
                                                    <a href="{{route('download.invoice', $order->id)}}" class="btn btn-info">Download Invoice</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>You did not ordered yet</p>
                                        @endforelse
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- order-area end -->
@endsection