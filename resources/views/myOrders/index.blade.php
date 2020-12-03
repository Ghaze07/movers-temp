@extends('layouts.master')
@section('content')
@include('sections.banner')
<body>
<div class="container-xl">
    <div class="">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row bg-dark text-white mt-3  py-1 px-3">
                    <div class="col-sm-12">
                        <b><h4 class="mt-2">Order Details</h4></b>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Item Name</th>
                        <th class="text-center">Reciever Name</th>
                        <th class="text-center">Reciever Mobile</th>
						<th class="text-center">Reciever Address</th>
						<th class="text-center">Delivery Charges</th>
						<th class="tetx-center">Order Total</th>												
                        <th class="text-center">Cash On Delivery</th>
                        <th class="text-center">Order Tracking</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="text-center">
                            @foreach ($order->orderItems as $orderItem)
                                {{$orderItem->farmProduct->product->name}}
                            @endforeach
                        </td>
                        <td class="text-center">{{$order->receiver_name}}</td>
                        <td class="text-center">{{$order->receiver_mobile}}</td>
                        <td class="text-center">{{$order->address->complete_address}}</td>
						<td class="text-center">RS {{$order->delivery_charges}}</td>
						<td class="text-center">RS {{$order->order_total}}</td>
                        <td class="text-center">RS {{$order->cash_on_delivery}}</td>
                        <td class="text-center"><a class="text-success" href="{{url('/orderStatus/'.$order->id)}}">Tracking</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>        
</div>     
@endsection
