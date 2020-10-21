@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Blogs:</h2>
            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogs as $blog)
                        <tr class="{{ ($blog->published) ? '' : 'text-muted' }}">
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->author->name_en }}</td>
                            <td>{{ ($blog->published ) ? 'Published' : 'Unpublished' }}</td>
                            <td>{{ $blog->views }}</td>
                            <td>{{ $blog->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
@endsection