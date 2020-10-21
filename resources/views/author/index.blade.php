@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Authors:</h2>
            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Name EN</th>
                        <th>Name UR</th>
                        <th>Title EN</th>
                        <th>Title UR</th>
                        <th>Posts</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($authors as $author)
                        <tr class="">
                            <td>{{ $author->name_en }}</td>
                            <td>{{ $author->name_ur }}</td>
                            <td>{{ $author->title_en }}</td>
                            <td>{{ $author->title_ur }}</td>
                            <td>{{ $author->blogs->count() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $authors->links() }}
            </div>
        </div>
    </div>
@endsection