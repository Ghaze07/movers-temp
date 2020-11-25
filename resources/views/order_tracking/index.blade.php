@extends('layouts.dashboard')

@section('content')
<div class="row align-items-end content">
    <div class="col-12 justify-content-around">
        <h2>Measuring Units:</h2>
        <div>
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($measuringUnits as $unit)
                    <tr class="{{ ($unit->status) ? '' : 'text-muted' }}">
                        <td>{{ $unit->name }}</td>
                        <td>{{ ($unit->status) ? 'Active' : 'Inactive' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $measuringUnits->links() }}
        </div>
    </div>
</div>
@endsection