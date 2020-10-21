@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Product Sources:</h2>
            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Product Source</th>
                        <th>Associated Products</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productSources as $source)
                        <tr class="{{ ($source->status) ? '' : 'text-muted' }}">
                            <td>{{ $source->source }}</td>
                            <td>{{ $source->farmProducts()->count() }}</td>
                            <td>{{ ($source->status) ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $productSources->links() }}
            </div>
        </div>
    </div>
@endsection