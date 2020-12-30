@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Services:</h2>
            
            <!-- Button trigger for Add_Country_modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcountry">
                Add Service
            </button>
            <!-- Start Add Country Modal -->
            <div class="modal fade" id="addcountry" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('services.store') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="cname">Service Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Service Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="sname">Image Title</label>
                                    <input type="text" name="image_title" class="form-control" placeholder="Enter Image Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="sname">First Trait</label>
                                    <input type="text" name="first_trait" class="form-control" placeholder="Enter First Trait" required>
                                </div>
                                <div class="form-group">
                                    <label for="sname">Second Trait</label>
                                    <input type="text" name="second_trait" class="form-control" placeholder="Enter Second Trait" required>
                                </div>
                                <div class="form-group">
                                    <label for="sname">Third Trait</label>
                                    <input type="text" name="third_trait" class="form-control" placeholder="Enter Third Trait" required>
                                </div>
                                <div class="form-group">
                                    <label for="sname">Fourth Trait</label>
                                    <input type="text" name="fouth_trait" class="form-control" placeholder="Enter Fourth Trait">
                                </div>
                                <div class="form-group">
                                    <label for="status">Select Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="1">active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Add Country Modal -->
            <div class="mt-2">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Image Title</th>
                            <th>First Trait</th>
                            <th>Second Trait</th>
                            <th>Third Trait</th>
                            <th>Fourth Trait</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr class="{{ ($service->status) ? '' : 'text-muted' }}">
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->image_title }}</td>
                            <td>{{ $service->first_trait }}</td>
                            <td>{{ $service->second_trait }}</td>
                            <td>{{ $service->third_trait }}</td>
                            <td>{{ $service->fourth_trait }}</td>
                            <td>{{( $service->status) ? 'Active' : 'Inactive' }}</td>
                            <td>                               
                                <button type="button"  class="btn btn-primary btn-sm mr-1">Edit</button> 
                                <button type="button"  class="btn btn-danger btn-sm mr-1">Delete</button>                               
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $services->links() }}
            </div>
        </div>
    </div>
@endsection