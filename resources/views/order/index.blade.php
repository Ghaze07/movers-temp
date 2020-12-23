@extends('layouts.dashboard')

@section('content')
<div class="row align-items-end content">
    <div class="col-12 justify-content-around">
        <h2>Orders:</h2>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
             {{ session('status')}}
            </div>
           @endif
           @if (session('error'))
            <div class="alert alert-danger" role="alert">
             {{ session('error')}}
            </div>
           @endif
        <div class="mb-3">
        <create-order :users="{{ json_encode($users) }}" :farms="{{ json_encode($farms) }}" :regions="{{ json_encode($regions) }}"></create-order>
        </div>
            <div class="row">    
                <form class="form-inline" method="GET" action="">
                    @csrf
                        <div class="form-group col-auto">
                            <label class="mr-sm-2 sr-only" for="status">Status</label>
                            <select name="status" class="custom-select mb-2">
                                <option value="">Select status</option>
                                @foreach($order_statuses as $order_status)
                                    <option value="{{ $order_status->id }}">{{ $order_status->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group input-group mb-2 mr-sm-2">
                          <input type="date" class="form-control input-sm" id="from" name="from">
                        </div>
                        <div class="form-group form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">To:</label>
                          <input type="date" class="form-control input-sm" id="to" name="to">
                        </div>
                    
                        <button type="submit"  class="btn btn-primary mb-2" onclick="Filter(this)">Filter</button>
                        <button type="submit"  class="btn btn-primary mb-2 ml-1" onclick="Export(this)">Export to Bykea</button>
                        <button type="submit"  class="btn btn-primary mb-2 ml-1" onclick="Labels(this)">Generate Labels</button>
                </form> 
                <span>   
                <a href="{{route('order.index')}}" class="btn btn-danger ml-1">Clear Filter</a>     
                 
            </div>

        <div>
            <form method="POST" action="{{ route('order.updateStatus') }}">
                @csrf
                <div class="row">
                <div class="form-group col-auto">
                    <select name="status" class="custom-select mb-2" onchange="this.form.submit()"  required>
                        <option value="">Change status</option>
                        @foreach($order_statuses as $order_status)
                            <option value="{{ $order_status->id}}">{{ $order_status->status }}</option>
                        @endforeach
                    </select>
                </div>
                </div>

            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th><input type="checkbox" class="selectall"></th>
                    <th>Farm</th>
                    <th>Customer Name</th>
                    <th>Mobile</th>
                    <th>City</th>
                    <th>Quantity</th>
                    <th>COD</th>
                    <th>Processing Option</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $totalQuantity = 0;
                    @endphp
                @foreach($orders as $order)
                    <tr>
                        <td><input type="checkbox" name="ids[]" class="checkbox" value="{{ $order->id }}"></td>
                        <td>{{ $order->farm->name }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->user->mobile }}</td>
                        <td>{{ $order->address->city->name }}</td>
                        <td>
                            @foreach ($order->orderItems as $orderItem)
                                @php
                                    $totalQuantity += $orderItem->quantity;
                                @endphp
                            @endforeach
                            {{ $totalQuantity }}
                        </td>
                        <td>{{ $order->cash_on_delivery }}</td> 
                        <td>{{ $order->processing_option }}</td>
                        <td>{{ $order->orderStatus->status }}</td>
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
        </form>
        </div>
        <div>
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
@push('scripts')
    
<script src="http://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    function Export(event) {
        event.form.action = "{{route('order.excel')}}";
    }

    function Filter(event) {
        event.form.action = "{{route('order.index')}}";
    }

    function Labels(event) {
        event.form.action = "{{route('orders.labels')}}";
    }

    $(document).ready(function () {
        $('.selectall').click(function(){
		$('.checkbox').prop('checked', $(this).prop('checked'));
	})
    
	$('.checkbox').change(function(){
		var total = $('.checkbox').length;
		var number = $('.checkbox:checked').length;
		if(total == number){
			$('.selectall').prop('checked', true);
		} else{
			$('.selectall').prop('checked', false);
			
		}
	})
    });

</script>

@endpush
