@extends('frontend.master')

@section('content')
<div class="row py-5">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Return Order</h3>
                <p class="p-2 yellloww" style="border-radius: 4px; font-size: 17px;
                border-radius: 5px 5px 5px 5px;">Order ID: {{$order_info->order_id}}</p>
            </div>
            <div class="card-body">
                <form action="{{route('order.return.store', $order_info->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Return Reason</label>
                        <textarea name="reason" class="form-control" cols="30" rows="10"></textarea>
                        @error('reason')
                            <strong class="text-danger">Enter the reason of return product.</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Images</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn greeenn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>   
@endsection