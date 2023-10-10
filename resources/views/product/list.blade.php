@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Product List</h3>
                <a href="{{route('add.product')}}" class="btn btn-primary"><i data-feather="plus"></i>Add New Product</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>After Discount</th>
                        <th>Preview</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($products as $sl=>$product)
                    <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->discount}}</td>
                        <td>{{$product->after_discount}}</td>
                        <td>
                            <img src="{{asset('uploads/product/preview/')}}/{{$product->prev_img}}" alt="">
                        </td>
                        <td>
                            <div class="toggle">
                                <input type="checkbox" {{$product->status == 1 ? 'checked':''}} class="status" data-id="{{$product->id}}" data-toggle="toggle" value="{{$product->status}}">
                            </div>
                        </td>
                        <td>
                            <a href="{{route('inventory', $product->id)}}" class="btn btn-info btn-icon">
                                <i data-feather="layers"></i>
                            </a>
                            <a href="{{route('product.edit', $product->id)}}" class="btn btn-primary btn-icon">
                                <i data-feather="eye"></i>
                            </a>
                            <a href="{{route('product.delete', $product->id)}}" class="btn btn-danger btn-icon">
                                <i data-feather="trash"></i>
                            </a>
                        </td>
                    @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css_cdn')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('footer_script')
    <script>
        $('.status').change(function(){
            if ($(this).val() != 1){
                $(this).attr('value', 1)
            }
            else{
                $(this).attr('value', 0)
            }

            var status = $(this).val();
            var product_id = $(this).attr('data-id');
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'/getstatus',
                type: 'POST',
                data:{'product_id': product_id, 'status' : status},

                success:function(data){
                    
                }
            });
        })
    </script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection