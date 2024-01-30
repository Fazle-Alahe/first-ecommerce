@extends('layouts.admin')
@section('content')
@can('subscriber_access')
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
                        @can('subscriber_action_access')
                        <td>
                            <a href="" class="btn btn-info">Send Offer</a>
                        </td>
                        @endcan
                    </tr>
                @endforeach
                
            </table>
        </div>
    </div>
</div>
@else
<h3 class="secondary">You dont have to access this page</h3>
@endcan  
@endsection