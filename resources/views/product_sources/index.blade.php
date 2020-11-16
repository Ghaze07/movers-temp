@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Product Sources:</h2>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
             {{ session('status')}}
            </div>
           @endif
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcategory">
                Add New Product Source
            </button><br><br>
            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Product Source</th>
                        <th>Associated Products</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productSources as $productSource)
                        <tr class="{{ ($productSource->status) ? '' : 'text-muted' }}">
                            <td>{{ $productSource->source }}</td>
                            <td>{{ $productSource->farmProducts()->count() }}</td>
                            <td>{{ ($productSource->status) ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">                            
                                <button type="button" style="margin:2px;" class="btn btn-success" data-toggle="modal" data-target="{{'#editcategory'.$productSource->id}}">Edit</button>                              
                                <button type="submit" style="margin:2px;" class="btn btn-danger" data-toggle="modal" data-target="{{'#deletecategory'.$productSource->id}}">Delete</button>

                                {{-- start Delete Modal --}}
                            <div class="modal fade" id="{{'deletecategory'.$productSource->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Product Source</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('sources.destroy',$productSource->id) }}" method="POST">
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
                               <div class="modal fade" id="{{'editcategory'.$productSource->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Product Source</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{ route('sources.update',$productSource->id) }}"  method="POST">          
                                        @method('put')
                                         @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="sname">Product Source Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $productSource->source }}" placeholder="Enter Product Source">
                                            </div>
                                            <div class="form-group">
                                                 <label for="status">Select Status</label>
                                                 <select class="form-control" name="status">
                                                     <option value="1" {{ ($productSource->status) ? 'selected' : '' }}>active</option>
                                                     <option value="0" {{ ($productSource->status) ? '' : 'selected' }}>inactive</option>
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
                            

                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $productSources->links() }}
            </div>

                        <!-- Add_Product_Source_Modal -->
                        <div class="modal fade" id="addcategory" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Product Source</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                            <form action="{{ action('ProductSourcesController@store') }}" method="POST">
                                {{ csrf_field() }}
                                   <div class="modal-body">
                                    <div class="form-group">
                                        <label for="cname">Product Source Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter  Name">
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
                        
                        <!-- {{-- End Add_Product_Modal --}} -->
            
        </div>
    </div>
@endsection