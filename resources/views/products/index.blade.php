@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Products :</h2>
            @if (session('status'))
                 <div class="alert alert-success" role="alert">
                  {{ session('status')}}
                 </div>
                @endif
            {{-- Add New Product Button --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addproducts">
                Add New Product
            </button><br><br>

            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="{{ ($product->status) ? '' : 'text-muted' }}">
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td> 
                            <td>{{ ($product->status) ? 'Active' : 'Inactive' }}</td>
                            <td> 
                                <div class="btn-group" role="group" aria-label="Basic example">                            
                                <button type="button" style="margin:2px;" class="btn btn-success text-center" data-toggle="modal" data-target="{{'#editproduct'.$product->id}}">Edit</button>                              
                                <button type="submit" style="margin:2px;" class="btn btn-danger text-center" data-toggle="modal" data-target="{{'#deleteproduct'.$product->id}}">Delete</button> 
                                </div>
                             {{-- start Delete Modal --}}
                            <div class="modal fade" id="{{'deleteproduct'.$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
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
                               <div class="modal fade" id="{{'editproduct'.$product->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{ route('products.update',$product->id) }}"  method="POST">          
                                        @method('put')
                                         @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="sname">Product Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" placeholder="Enter Product Code">
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Select Category</label>
                                                <select class="form-control" name="product_category_id">
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id}}" {{ $category->id == $product->product_category_id ? 'selected' : '' }}>  {{ $category->name }}</option>
                                                    @endforeach
                                                </select>  
                                            </div>
                                            <div class="form-group">
                                                 <label for="status">Select Status</label>
                                                 <select class="form-control" name="status">
                                                     <option value="1" {{ ($product->status) ? 'selected' : '' }}>active</option>
                                                     <option value="0" {{ ($product->status) ? '' : 'selected' }}>inactive</option>
                                                 </select>
                                            </div>             
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                 <button type="submit" class="btn btn-primary">Update</button>
                                             </div>
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
                {{ $products->links() }}
            </div>
            <!-- Add_Products_Modal -->
              <div class="modal fade" id="addproducts" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <form action="{{ action('ProductsController@store') }}" method="POST">
                    {{ csrf_field() }}
                       <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <select class="form-control" name="product_category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id}}">{{ $category->name }}</option>
                            @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Product Name">
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
            {{-- End Add_Products_Modal --}} 

        </div>
    </div>
@endsection