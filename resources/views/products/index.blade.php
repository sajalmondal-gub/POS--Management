@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-9">
            <div class="card">
                   <div class="card-header"> 
                    <a href="#" Style="float:right" class="btn "
                     data-bs-toggle="modal" data-bs-target="#addproduct">
                    <i class="fa fa-plus"></i> Add new product</a></div>
                    <div class="card-body">
                        <table class=" table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Alert Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                <tr>
                                    <td> {{ $key+1 }}</td>
                                    <td> {{ $product->product_name }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>{{ number_format($product->price,2) }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    
                                    <td>@if($product->alert_stock >= $product->quantity) <span >Low Stock >{{ $product->alert_stock }}</span>
                                        @else <span > {{ $product->alert_stock }}</span>
                                        @endif 

                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editUser{{ $product->id }}"><i class="fa fa-edit">
                                                 </i> Edit</a>
                                                 <a href="#" class="btn btn-sm btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteUser{{ $product->id }}"> <i class="fa fa-trash"></i> remove</a>
                                        </div>
                                    </td>
                                    
                                </tr>

                                <!-- model of user details start-->

<div class="modal right fade" id="editUser{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="staticBackdropLabel">Edit Product</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       
      </div>
      <div class="modal-body">
       
      <form action="{{ route('products.update',$product->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="">Product Name</label>
            <input type="text" name="product_name" id="" value="{{ $product->product_name }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Brand</label>
             <input type="text" name="brand" id="" value=" {{ $product->brand }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Price</label>
            <input type="number" name="price" id="" value="{{ $product->price }}"  class="form-control">
        </div>
        <div class="form-group">
            <label for="">Quantity</label>
            <input type="number" name="quantity" id="" value="{{ $product->quantity }}"  class="form-control">
        </div>
        <div class="form-group">
            <label for="">Alert Stock</label>
            <input type="number" name="alert_stock" id="" value="{{ $product->alert_stock }}"  class="form-control">
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" id="" cols="30" rows="2"  class="form-control">{{ $product->description }}</textarea>
            
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary btn-block">Save</button>
        </div>
        </form>

        
      </div>
      <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
-->
    </div>
  </div>
</div>
<!-- model of user details end-->

                          <!-- remove  start-->

                          <div class="modal right fade" id="deleteUser{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="staticBackdropLabel">Delete User</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        
      </div>
      <div class="modal-body">
        <form action="{{ route('products.destroy', $product->id) }}" method="post">
        @csrf
        @method('delete')
       
        <p>Are you sure? {{ $product->name}} </p>
        <div class="modal-footer">
            
            <button type="submit" class="btn btn-primary btn-block" >remove</button>
        </div>
        </form>

        
      </div>
   
    </div>
  </div>
</div>
<!-- remove end-->

                                @endforeach
                               {{$products = DB::table('products')->simplePaginate(8);}} 
                            </tbody>
                            
                        </table>
                    
                    </div>
            </div>

            </div>
            <div class="col-md-3">
            <div class="card">
                   <div class="card-header"> <h4>Search user</h4></div>
                    <div class="card-body">
                       
                    ...........
                    </div>
            </div>
            </div>
          
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal right fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="staticBackdropLabel">Add Product</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('products.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Product Name</label>
            <input type="text" name="product_name" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Brand</label>
             <input type="text" name="brand" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Price</label>
            <input type="number" name="price" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Quantity</label>
            <input type="number" name="quantity" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Alert Stock</label>
            <input type="number" name="alert_stock" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>
            
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary btn-block">Save</button>
        </div>
        </form>

        
      </div>
      <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
-->
    </div>
  </div>
</div>



<Style>

    .modal.right .modal-dialog{
        top:0;
        right:0;
        margin-right:18vh;
    }
    .modal.fade:not(.in).right .modal-dialog{
        -webkit-transform:translate3d(25%,0,0);
        transform:translate3d(25%,0,0);
    }
</Style>
@endsection