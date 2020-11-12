@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Regions:</h2>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status')}}
                </div>
            @endif

            <!-- Button trigger for Add_Region_modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRegion">
                Add Region
            </button>

            <div class="mt-2">
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Country</th>
                        <th>Region</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($regions as $region)
                        <tr class="{{ ($region->status) ? '' : 'text-muted' }}">
                            <td>{{ $region->country->name }}</td>
                            <td>{{ $region->name }}</td>
                            <td>{{ ($region->status) ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" style="margin:2px;" class="btn btn-success" data-toggle="modal" data-target="{{'#editregion'.$region->id}}">Edit</button>
                                    <a type="submit" style="margin:2px;" class="btn btn-danger" data-toggle="modal" data-target="{{'#deleteregion'.$region->id}}">Delete</a>
                                </div>
                                {{-- start Delete Modal --}}
                                <div class="modal fade" id="{{'deleteregion'.$region->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Region</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('regions.destroy',$region->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--End Delete Modal --}}
                                {{-- start Edit_Region_Modal --}}
                                <div class="modal fade" id="{{'editregion'.$region->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Region</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('regions.update',$region->id) }}" method="POST">
                                                @method('put')
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="country">Select Country</label>
                                                        <select class="form-control" name="country">
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country->id}}">{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sname">Region Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $region->name }}" placeholder="Enter Country Code">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">Select Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="1" {{ ($region->status) ? 'selected' : '' }}>active</option>
                                                            <option value="0" {{ ($region->status) ? '' : 'selected' }}>inactive</option>
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
                                {{-- End Edit_Region_Modal --}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $regions->links() }}
            </div>

            {{-- Add_Region_Modal --}}
            <div class="modal fade" id="addRegion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Region</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ action('RegionController@store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="country">Select Country</label>
                                    <select class="form-control" name="country">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id}}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Region Title</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Region Title">
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
            {{-- End Add_Region_Modal --}}

        </div>
    </div>
@endsection