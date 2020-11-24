@extends('layouts.dashboard')

@section('content')
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2><a href="{{ route('farm', ['id' => $farm->id]) }}">{{ $farm->name }}</a></h2>
            <h3>Farm Products:</h3>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
             {{ session('status')}}
            </div>
           @endif
       {{-- Add New FarmProduct Button --}}
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addfarmproducts">
           Add New Farm Product
       </button><br><br>
            <div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Source</th>
                        <th>In Stock</th>
                        <th>Order Quantity</th>
                        <th>Unit Price</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($farmProducts as $farmProduct)
                        <tr class="{{ ($farmProduct->status) ? '' : 'text-muted' }}">
                            <td>{{ $farmProduct->product->name }}</td>
                            <td>{{ $farmProduct->product->category->name }}</td>
                            <td>{{ $farmProduct->productSource->source }}</td>
                            <td>{{ ($farmProduct->in_stock) ? 'Yes' : 'No'}}</td>
                            <td>{{ $farmProduct->minimum_order_quantity }} - {{ $farmProduct->maximum_order_quantity }}</td>
                            <td>{{ $farmProduct->unit_price }}</td>
                            <td>{{ $farmProduct->measuringUnit->name }}</td>
                            <td>{{ ($farmProduct->status) ? 'Active' : 'Inactive' }}</td>
                            <td> 
                                <div class="btn-group" role="group" aria-label="Basic example">                            
                                <button type="button" style="margin:2px;" class="btn btn-success" data-toggle="modal" data-target="{{'#editproduct'.$farmProduct->id}}">Edit</button>                              
                                <button type="submit" style="margin:2px;" class="btn btn-danger" data-toggle="modal" data-target="{{'#deleteproduct'.$farmProduct->id}}">Delete</button> 
                                </div>
                             {{-- start Delete Modal --}}
                            <div class="modal fade" id="{{'deleteproduct'.$farmProduct->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <form action="{{ route('farmsproduct.destroy',$farmProduct->id) }}" method="POST">
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
                               <div class="modal fade" id="{{'editproduct'.$farmProduct->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <form action="{{ route('farmsproduct.update',$farmProduct->id) }}"  method="POST">          
                                        @method('put')
                                         @csrf
                                         <div class="modal-body">
                                            <div class="form-group">
                                                <label for="category">Select Product </label>
                                                <select class="form-control" name="product_id">
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id}}"  {{ $product->id == $farmProduct->product_id ? 'selected' : '' }} >{{ $product->name }}</option>
                                                @endforeach
                                              </select>
                                               </div>
                                               <div class="form-group">
                                                <label for="category">Select Farm </label>
                                                <select class="form-control" name="farm_id">
                                                @foreach($farms as $farm)
                                                    <option value="{{ $farm->id}}">{{ $farm->name }}</option>
                                                @endforeach
                                                </select>
                                              </div>
                                                <div class="form-group">
                                                    <label for="category">Select Product Source</label>
                                                    <select class="form-control" name="product_source_id">
                                                    @foreach($productSources as $productSource)
                                                        <option value="{{ $productSource->id}}" {{ $productSource->id == $farmProduct->product_source_id ? 'selected' : '' }}  >{{ $productSource->source }}</option>
                                                    @endforeach
                                                  </select>
                                                 </div>
                                                <div class="form-group">
                                                    <label for="category">Select Measuring Unit</label>
                                                    <select class="form-control" name="measuring_unit_id">
                                                    @foreach($measuringUnits as $measuringUnit)
                                                        <option value="{{ $measuringUnit->id}}"  {{ $measuringUnit->id == $farmProduct->measuring_unit_id ? 'selected' : '' }}>{{ $measuringUnit->name }}</option>
                                                    @endforeach
                                                    </select>
                                                  </div> 
                                            <div class="form-group">
                                                <label for="sname">Minimum Order Quantity</label>
                                            <input type="text" name="minimum_order_quantity" class="form-control" value="{{  $farmProduct->minimum_order_quantity }}" placeholder="Enter Minimum Quantity">
                                            </div>
                                            <div class="form-group">
                                                <label for="sname">Maximum Order Quantity </label>
                                            <input type="text" name="maximum_order_quantity" class="form-control" value="{{$farmProduct->maximum_order_quantity}}" placeholder="Enter Maximum Quantity">
                                            </div>
                                            <div class="form-group">
                                                <label for="sname">Unit Price</label>
                                            <input type="text" name="unit_price" class="form-control" value="{{ $farmProduct->unit_price }}" placeholder="Enter Unit Price">
                                            </div>

                                            <div class="form-group">
                                                 <label for="status">Select Status</label>
                                                 <select class="form-control" name="status">
                                                     <option value="1" {{ ($farmProduct->status) ? 'selected' : '' }}>active</option>
                                                     <option value="0" {{ ($farmProduct->status) ? '' : 'selected' }}>inactive</option>
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
                {{ $farmProducts->links() }}
            </div>
                           <!-- Add_FarmProducts_Modal -->
                           <div class="modal fade" id="addfarmproducts" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Farm Products</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                            <form action="{{ action('FarmProductController@store') }}" method="POST">
                                {{ csrf_field() }}
                                   <div class="modal-body">
                                    
                                        <div class="form-group">
                                        <label for="category">Select Product </label>
                                        <select class="form-control" name="product_id">
                                        @foreach($products as $product)
                                            <option value="{{ $product->id}}">{{ $product->name }}</option>
                                        @endforeach
                                        </select>
                                         </div>  
                                      <div class="form-group">
                                        <label for="category">Select Farm </label>
                                        <select class="form-control" name="farm_id">
                                        @foreach($farms as $farm)
                                            <option value="{{ $farm->id}}">{{ $farm->name }}</option>
                                        @endforeach
                                        </select>
                                      </div>
            
                                      <div class="form-group">
                                        <label for="category">Select Product Source</label>
                                        <select class="form-control" name="product_source_id">
                                        @foreach($productSources as $productSource)
                                            <option value="{{ $productSource->id}}">{{ $productSource->source }}</option>
                                        @endforeach
                                        </select>
                                      </div> 
            
                                      <div class="form-group">
                                        <label for="category">Select Measuring Unit</label>
                                        <select class="form-control" name="measuring_unit_id">
                                        @foreach($measuringUnits as $measuringUnit)
                                            <option value="{{ $measuringUnit->id}}">{{ $measuringUnit->name }}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="category">Unit Price</label>
                                        <input  class="form-control" type="text" placeholder="Enter Unit Price" name="unit_price">
                                        </select>
                                      </div>
            
            
            
                                      <div class="form-group">
                                        <label for="category">Select Minimum Order Quantity</label>
                                        <input  class="form-control" type="text" placeholder="Enter Minimum Order Quantity" name="minimum_order_quantity">
                                        </select>
                                      </div>
            
                                      <div class="form-group">
                                        <label for="category">Select Maximum Order Quantity</label>
                                        <input  class="form-control" type="text" placeholder="Enter Maximum Order Quantity" name="maximum_order_quantity">
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
                        {{-- End Add_FarmProducts_Modal --}} 
            
        </div>
    </div>
@endsection