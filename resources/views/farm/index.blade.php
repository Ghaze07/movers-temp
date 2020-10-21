@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Fish Farms:</h2>
            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Manager</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Mobile-2</th>
                        <th>Products</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($farms as $farm)
                        <tr class="{{ ($farm->status) ? '' : 'text-muted' }}">
                            <td>
                                <a href="{{ route('farm', ['id' => $farm->id]) }}">
                                    {{ $farm->name }}
                                </a>
                            </td>
                            <td>{{ $farm->manager }}</td>
                            <td>{{ $farm->address }}</td>
                            <td>{{ $farm->city->name }}</td>
                            <td>{{ $farm->email }}</td>
                            <td>{{ $farm->mobile1 }}</td>
                            <td>{{ $farm->mobile2 }}</td>
                            <td>
                                <a href="{{ route('farm.products', ['farm'=>$farm->id]) }}">
                                    {{ $farm->farmProducts()->count() }} Item(s)
                                </a>
                            </td>
                            <td>{{ ($farm->status) ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $farms->links() }}
            </div>
        </div>
    </div>
@endsection