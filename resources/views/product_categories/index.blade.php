@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Product Categories:</h2>
            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr class="{{ ($category->status) ? '' : 'text-muted' }}">
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->products()->count() }}</td>
                            <td>{{ ($category->status) ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection