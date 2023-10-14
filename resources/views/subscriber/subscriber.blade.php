@extends('layouts.admin')
@section('content')
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Subscriber List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($subscibers as $sl=>$subsciber)
                        <tr>
                            <td>{{$sl+1}}</td>
                            <td>{{$subsciber->email}}</td>
                            <td>
                                <a href="" class="btn btn-info">Send Offer</a>
                            </td>
                        </tr>
                    @endforeach
                    
                </table>
            </div>
        </div>
    </div>
@endsection