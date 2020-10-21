@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Cities:</h2>
            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Country</th>
                        <th>Region</th>
                        <th>City</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cities as $city)
                        <tr class="{{ ($city->status) ? '' : 'text-muted' }}">
                            <td>{{ $city->region->country->name }}</td>
                            <td>{{ $city->region->name }}</td>
                            <td>{{ $city->name }}</td>
                            <td>{{ ($city->status) ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $cities->links() }}
            </div>
        </div>
    </div>
@endsection