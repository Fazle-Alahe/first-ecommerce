@extends('layouts.admin')
@section('content')
@can('order_access')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>All Orders</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr class="text-center">
                        <th>SL</th>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($orders as $sl=>$order )
                        <tr class="text-center">
                            <td>{{$sl+1}}</td>
                            <td>{{$order->order_id}}</td>
                            <td>&#2547;{{$order->total}}</td>
                            <td>{{$order->created_at->diffForHumans()}}</td>
                            <td class="status_c">
                                @if ($order->status == 0)
                                    <span class="secondary abc">Placed</span>
                                @elseif ($order->status == 1)
                                    <span class="bluuee abc">Processing</span>
                                @elseif ($order->status == 2)
                                    <span class="yellloww abc">Shipping</span>
                                @elseif ($order->status == 3)
                                    <span class="skybluee abc">Ready for Deliver</span>
                                @elseif ($order->status == 4)
                                    <span class="greeenn abc">Delivered</span>
                                @elseif ($order->status == 5)
                                    <span class="reedd abc">Cancel</span>
                                @elseif ($order->status == 6)
                                    <span class="reedd abc">Return</span>
                                @endif
                            </td>
                            @can('order_action')
                            <td>
                                <form action="{{route('order.status.update',$order->id)}}" method="POST">
                                    @csrf
                                        <div class="dropdown">
                                            <button {{$order->status == 5?'disabled':''}} class="btn" type="button" data-toggle="dropdown" aria-expanded="false">
                                                Change Status
                                            </button>
                                            <div class="dropdown-menu">
                                                <button name="status" value="0" class="dropdown-item bg-{{$order->status == 0?'secondary':''}}">Placed</button>
                                                <button name="status" value="1" class="dropdown-item bg-{{$order->status == 1?'secondary':''}}">Processing</button>
                                                <button name="status" value="2" class="dropdown-item bg-{{$order->status == 2?'secondary':''}}">Shipping</button>
                                                <button name="status" value="3" class="dropdown-item bg-{{$order->status == 3?'secondary':''}}">Ready for Deliver</button>
                                                <button name="status" value="4" class="dropdown-item bg-{{$order->status == 4?'secondary':''}}">Delivered</button>
                                                <a href="{{route('order.cancel.admin',$order->id)}}" name="status" value="5" class="dropdown-item bg-{{$order->status == 5?'secondary':''}}">Cancel</a>
                                            </div>
                                        </div>
                                </form>
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@else
<h3 class="secondary">You dont have to access this page</h3>
@endcan  
@endsection

@section('footer_script')
    
@if (session('order_cancle'))
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })

    Toast.fire({
    icon: 'success',
    title: '{{session('order_cancle')}}'
    })
</script>
@endif
@endsection