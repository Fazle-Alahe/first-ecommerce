@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Coupon List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Coupon</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Validity</th>
                            <th>Limit</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($coupons as $sl=>$coupon)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $coupon->coupon }}</td>
                            <td>{{ $coupon->type==1?'Solid':'Percentage' }}</td>
                            <td>{{ $coupon->amount }}</td>
                            <td>{{ $coupon->validity }}</td>
                            <td>{{ $coupon->limit }}</td>
                            <td><a href="{{route('coupon.status', $coupon->id)}}" class="btn btn-{{$coupon->status==1?'success':'secondary'}}">{{ $coupon->status==1?'Active':'Deactive'}}</a></td>
                            <td><a href="" class="btn btn-danger">Delete</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add New Coupon</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('add.coupon')}}" method="POST">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                         @endif
                        <div class="mb-3">
                            <label class="form-label">Coupon</label>
                            <input type="text" class="form-control" name="coupon">
                            @error('coupon')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select class="form-control" name="type">
                                <option value="">Select Type</option>
                                <option value="1">Solid</option>
                                <option value="2">Parcentage</option>
                            </select>
                            @error('type')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" class="form-control" name="amount">
                            @error('amount')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Validity</label>
                            <input type="date" class="form-control" name="validity">
                            @error('validity')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Limit</label>
                            <input type="number" class="form-control" name="limit">
                            @error('limit')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection