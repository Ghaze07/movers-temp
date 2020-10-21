@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Countries:</h2>
            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Country Name</th>
                        <th>Country Code</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($countries as $country)
                        <tr class="{{ ($country->status) ? '' : 'text-muted' }}">
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->short_name }}</td>
                            <td>{{ ($country->status) ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $countries->links() }}
            </div>
        </div>
    </div>
@endsection