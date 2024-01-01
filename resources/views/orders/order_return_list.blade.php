@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Order Return List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Order ID</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($order_return_lists as $sl=>$order_return_list)
                        <tr>
                            <td>{{$sl+1}}</td>
                            <td>{{App\Models\Order::find($order_return_list->order_id)->order_id}}</td>
                            <td>
                                <a href="{{route('returns.details', $order_return_list->id)}}" class="btn skybluee">View</a>
                                <a href="{{route('returns.accept', $order_return_list->id)}}" class="btn greeenn">Accept</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer_script')
     
@if (session('order_return'))
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
    title: '{{session('order_return')}}'
    })
</script>
@endif
@endsection