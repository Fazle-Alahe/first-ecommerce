@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Order Cancel List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Order ID</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($order_cancel_lists as $sl=>$order_cancel_list)
                        <tr>
                            <td>{{$sl+1}}</td>
                            <td>{{App\Models\Order::find($order_cancel_list->order_id)->order_id}}</td>
                            <td>
                                <a href="{{route('cancel.details', $order_cancel_list->id)}}" class="btn skybluee">View</a>
                                <a href="{{route('cancel.accept', $order_cancel_list->id)}}" class="btn greeenn">Accept</a>
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

@section('footer_script')
    @if (session('return'))
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
        title: '{{session('return')}}'
        })
    </script>
    @endif
@endsection