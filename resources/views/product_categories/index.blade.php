@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Product Categories:</h2>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
             {{ session('status')}}
            </div>
           @endif
            {{-- Add New Category Button --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcategory">
                Add New Category
            </button><br><br>

            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productCategories as $productCategory)
                        <tr class="{{ ($productCategory->status) ? '' : 'text-muted' }}">
                            <td>{{ $productCategory->name }}</td>
                            <td>{{ $productCategory->products()->count() }}</td>
                            <td>{{ ($productCategory->status) ? 'Active' : 'Inactive' }}</td>
                            <td> 
                                <div class="btn-group" role="group" aria-label="Basic example">                            
                                <button type="button" style="margin:2px;" class="btn btn-success" data-toggle="modal" data-target="{{'#editcategory'.$productCategory->id}}">Edit</button>                              
                                <button type="submit" style="margin:2px;" class="btn btn-danger" data-toggle="modal" data-target="{{'#deletecategory'.$productCategory->id}}">Delete</button> 
                                </div>
                             {{-- start Delete Modal --}}
                            <div class="modal fade" id="{{'deletecategory'.$productCategory->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('categories.destroy',$productCategory->id) }}" method="POST">
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
                               <div class="modal fade" id="{{'editcategory'.$productCategory->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{ route('categories.update',$productCategory->id) }}"  method="POST">          
                                        @method('put')
                                         @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="sname">category Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $productCategory->name }}" placeholder="Enter Category">
                                            </div>
                                            <div class="form-group">
                                                 <label for="status">Select Status</label>
                                                 <select class="form-control" name="status">
                                                     <option value="1" {{ ($productCategory->status) ? 'selected' : '' }}>active</option>
                                                     <option value="0" {{ ($productCategory->status) ? '' : 'selected' }}>inactive</option>
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
                {{ $productCategories->links() }}
            </div>

                         <!-- Add_Category_Modal -->
                         <div class="modal fade" id="addcategory" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                            <form action="{{ action('ProductCategoriesController@store') }}" method="POST">
                                {{ csrf_field() }}
                                   <div class="modal-body">
                                    <div class="form-group">
                                        <label for="cname">Name</label>
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
                        
                        {{-- End Add_Category_Modal --}}
            
                      
            
        </div>
    </div>
@endsection