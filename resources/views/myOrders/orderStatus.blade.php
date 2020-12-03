@extends('layouts.master')
@section('content')
@include('sections.banner')
<body>
<div class="container-xl">
    <div class="">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row bg-dark text-white mt-3 py-1 px-3">
                    <div class="col-sm-12">
                        <b><h4 class="mt-2">Order Status</h4></b>
                    </div>
                </div>
            </div>           
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Order Number</th>
                        <th class="text-center">Order Status</th>
						<th class="text-center">Remarks</th>
						<th class="text-center">Created At</th>
                        <th class="text-center">My Orders</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderTracking as $Ordertracking)
                    <tr>
                        <td class="text-center">{{$Ordertracking->order->order_number}}</td>
						<td class="text-center">{{$Ordertracking->orderstatus->status}}</td>
						<td class="text-center">{{$Ordertracking->remarks}}</td>
						<td class="text-center">{{$Ordertracking->created_at}}</td>
                        <td class="text-center"><a class="text-danger"  href="{{url('/myorders')}}">My Orders</a></td>                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>        
</div>
@endsection
