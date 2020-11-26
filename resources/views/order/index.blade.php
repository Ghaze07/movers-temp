@extends('layouts.dashboard')

@section('content')
<div class="row align-items-end content">
    <div class="col-12 justify-content-around">
        <h2>Orders:</h2>
        <div class="mb-3">


        <create-order :users="{{ json_encode($users) }}" :farms="{{ json_encode($farms) }}" :regions="{{ json_encode($regions) }}"></create-order>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Customer Name</th>
                    <th>Farm</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>COD</th>
                    <th>Processing Option</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->farm->name }}</td>
                        <td>{{ $order->address->complete_address }}</td>
                        <td>{{ $order->orderStatus->status }}</td>
                        <td>{{ $order->cash_on_delivery }}</td>
                        <td>{{ $order->processing_option }}</td>
                        <td>
                            <div class="d-flex">
                                <edit-order :order_prop="{{ json_encode($order) }}" :order_statuses="{{ json_encode($order_statuses) }}" :users="{{ json_encode($users) }}" :farms="{{ json_encode($farms) }}" :regions="{{ json_encode($regions) }}"></edit-order>
                                <button class="btn btn-danger btn-sm mr-1">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection