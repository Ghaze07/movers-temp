@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Regions:</h2>
            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Country</th>
                        <th>Region</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($regions as $region)
                        <tr class="{{ ($region->status) ? '' : 'text-muted' }}">
                            <td>{{ $region->country->name }}</td>
                            <td>{{ $region->name }}</td>
                            <td>{{ ($region->status) ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $regions->links() }}
            </div>
        </div>
    </div>
@endsection