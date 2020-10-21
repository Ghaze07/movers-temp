@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2><a href="{{ route('farm', ['id' => $farm->id]) }}">{{ $farm->name }}</a></h2>
            <h3>Farm Products:</h3>

            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Source</th>
                        <th>In Stock</th>
                        <th>Order Quantity</th>
                        <th>Unit Price</th>
                        <th>Unit</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="{{ ($product->status) ? '' : 'text-muted' }}">
                            <td>{{ $product->product->name }}</td>
                            <td>{{ $product->product->category->name }}</td>
                            <td>{{ $product->productSource->source }}</td>
                            <td>{{ ($product->in_stock) ? 'Yes' : 'No'}}</td>
                            <td>{{ $product->minimum_order_quantity }} - {{ $product->maximum_order_quantity }}</td>
                            <td>{{ $product->unit_price }}</td>
                            <td>{{ $product->measuringUnit->name }}</td>
                            <td>{{ ($product->status) ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection