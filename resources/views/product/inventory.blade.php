@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Inventory for, <strong>{{$products->product_name}}</strong></h3>
                </div>
                @if (session('delete'))
                    <div class="alert alert-danger">{{session('delete')}}</div>
                @endif
                @if (session('increment'))
                    <div class="alert alert-info">{{session('increment')}}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($inventories as $inventory)
                            <tr>
                                <td>{{$inventory ->rel_to_color ->color_name}}</td>
                                <td>{{$inventory ->rel_to_size ->size_name}}</td>
                                <td>{{$inventory ->quantity}}</td>
                                <td>
                                    <a href="{{route('inventory.delete', $inventory->id)}}" class="btn btn-danger btn-icon del_btn">
                                        <i data-feather="trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add Inventory</h4>
                </div>
                <div class="card-body">      
                    <form action="{{route('inventory.store', $products->id)}}" method="POST">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Product</label>
                            <input type="text" disabled value="{{$products->product_name}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <select name="color_id" class="form-control">
                                <option value="">Select Color</option>
                                @foreach ($colors as $color)
                                    <option value="{{$color->id}}">{{$color->color_name}}</option>
                                @endforeach
                            </select>
                            @error('color_id')
                                <strong class="text-danger">Color is required.</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select name="size_id" class="form-control">
                                <option value="">Select Size</option>
                                @foreach (App\Models\Size::where('category_id', $products->category_id)->get() as $size)
                                    <option value="{{$size->id}}">{{$size->size_name}}</option>
                                @endforeach
                            </select>
                            @error('size_id')
                                <strong class="text-danger">Size is required.</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control">
                            @error('quantity')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Inventory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
