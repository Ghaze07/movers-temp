@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Countries:</h2>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status')}}
                </div>
            @endif

            <!-- Button trigger for Add_Country_modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcountry">
                Add Country
            </button>

            <div class="mt-2">
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Country Name</th>
                        <th>Country Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($countries as $country)
                        <tr class="{{ ($country->status) ? '' : 'text-muted' }}">
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->short_name }}</td>
                            <td>{{ ($country->status) ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" style="margin:2px;" class="btn btn-success" data-toggle="modal" data-target="{{'#editcountry'.$country->id}}">Edit</button>
                                    <a type="submit" style="margin:2px;" class="btn btn-danger" data-toggle="modal" data-target="{{'#deletecountry'.$country->id}}">Delete</a>
                                </div>
                                {{-- start Delete Modal --}}
                                <div class="modal fade" id="{{'deletecountry'.$country->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Country</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('countries.destroy',$country->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--End Delete Modal --}}

                                {{-- start Edit_Country_Modal --}}
                                <div class="modal fade" id="{{'editcountry'.$country->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit New Country</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('countries.update',$country->id) }}" method="POST">
                                                @method('put')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="cname">Country Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $country->name  }}" placeholder="Enter Country Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sname">Country Code</label>
                                                        <input type="text" name="short_name" class="form-control" value="{{ $country->short_name }}" placeholder="Enter Country Code">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">Select Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="1" {{ ($country->status) ? 'selected' : '' }}>active</option>
                                                            <option value="0" {{ ($country->status) ? '' : 'selected' }}>inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Edit_Country_Modal --}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $countries->links() }}
            </div>

            <!-- Add_Country_Modal -->
            <div class="modal fade" id="addcountry" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Country</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ action('CountryController@store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="cname">Country Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Country Name">
                                </div>
                                <div class="form-group">
                                    <label for="sname">Country Code</label>
                                    <input type="text" name="short_name" class="form-control" placeholder="Enter Country Code">
                                </div>
                                <div class="form-group">
                                    <label for="status">Select Status</label>
                                    <select class="form-control" name="status">
                                        <option>1</option>
                                        <option>0</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Insert</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Add_Country_Modal --}}

        </div>
    </div>
@endsection