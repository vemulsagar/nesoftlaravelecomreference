@extends('layouts.admin')
@section('page_name')
{{ $action }} Product
@endsection
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                
            </div>
            <div class="col-md-3" >
                <a href="{{ route('product.index')}}" class="btn btn-warning float-right display-block" style="
                        ">Manage Products</a>
            </div>
        </div>
        </br>
        @include('flash-message')

        <div class="row">
        
            <div class="col-md-12">
             
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">{{ $action }} Product</h3>
                </div>
                
                <form action="{{ $action_url}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($data->id))
                     @method('PUT')
                    @endif
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ old('name',isset($data->name)?$data->name:'')}}">
                    </div>

                    <div class="form-group">
                      <label for="model">Model</label>
                      <input type="text" class="form-control" name="model" id="model" placeholder="Enter Model" value="{{ old('model',isset($data->model)?$data->model:'')}}">
                    </div>
                    <div class="form-group">
                      <label for="category_id">Select Category</label>
                     <select name="category_id" id="category_id" class="form-control">
                      <option value="">Select Category</option>
                      @foreach ($category as $category_row)
                        
                        @php
                         $category_row_value=old('category_id',isset($data->category_id)?$data->category_id:'');
                         @endphp
                      <option value="{{ $category_row->id }}" {{$category_row_value==$category_row->id?'selected':''}}>{{ $category_row->name }}</option>
                      @endforeach
                     </select>
                    </div>

                    <div class="form-group">
                      <label for="brand_id">Select Brand</label>
                     <select name="brand_id" id="brand_id" class="form-control">
                      <option value="">Select Brand</option>
                      @foreach ($brand as $brand_row)
                        
                        @php
                         $brand_row_value=old('brand_id',isset($data->brand_id)?$data->brand_id:'');
                         @endphp
                      <option value="{{ $brand_row->id }}" {{$brand_row_value==$brand_row->id?'selected':''}}>{{ $brand_row->name }}</option>
                      @endforeach
                     </select>
                    </div>


                    <div class="form-group">
                      <label for="short_desc">Short Description</label>
                      <textarea name="short_desc" id="short_desc" cols="10" rows="3" class="form-control">{{ old('short_desc',isset($data->short_desc)?$data->short_desc:'')}}</textarea>
                      
                    </div>

                    <div class="form-group">
                      <label for="desc">Description</label>
                      <textarea name="desc" id="desc" cols="10" rows="3" class="form-control">{{ old('desc',isset($data->desc)?$data->desc:'')}}</textarea>
                      
                    </div>

                    <div class="form-group">
                      <label for="keywords">Keywords</label>
                      <textarea name="keywords" id="keywords" cols="10" rows="3" class="form-control">{{ old('keywords',isset($data->keywords)?$data->keywords:'')}}</textarea>
                      
                    </div>
                    
                    <div class="form-group">
                      <label for="technical_specifications">Technical Specifications</label>
                      <textarea name="technical_specifications" id="technical_specifications" cols="10" rows="3" class="form-control">{{ old('technical_specifications',isset($data->technical_specifications)?$data->technical_specifications:'')}}</textarea>
                      
                    </div>

                    <div class="form-group">
                      <label for="warranty">Warranty</label>
                      <textarea name="warranty" id="warranty" cols="10" rows="3" class="form-control">{{ old('warranty',isset($data->warranty)?$data->warranty:'')}}</textarea>
                      
                    </div>

                    <div class="form-group">
                      <label for="uses">Uses</label>
                      <textarea name="uses" id="uses" cols="10" rows="3" class="form-control">{{ old('uses',isset($data->uses)?$data->uses:'')}}</textarea>
                      
                    </div>
                   
                   
                   


                     

                      <div class="form-group">
                        <label for="product_images">Upload Product Images</label>
                        <input type="file" class="form-control" name="product_images[]" id="product_images" multiple>
                        @if(isset($data->productimages) && !empty($data->productimages))
                        
                        @foreach($data->productimages as $productimage)
                        
                        <a  target="_blank" href="{{asset('storage/media/'.$productimage->image)}}"><img src="{{asset('storage/media/'.$productimage->image)}}" style="width:50px;height:50px;" alt="no image"></a> 
                        @endforeach
                       
                        @endif
                      </div>

                      <div class="row">
                        <label>Product Attributes</label>
                        <div>
                          <table class="table table-bordered" id="dynamicAddRemove">
                              <tr>
                                  <th>Attribute Name</th>
                                  <th>Attribute Value</th>
                                  <th>Action</th>
                              </tr>
                              <tr>
                                  <td><input type="text" name="attr[0][name]" placeholder="Enter Name"
                                          class="form-control @error('attr.*.name') is-invalid @enderror" /></td>
                                  <td><input type="text" name="attr[0][value]" placeholder="Enter Value"
                                          class="form-control @error('attr.*.value') is-invalid @enderror" /></td>
                                  <td><button type="button" name="add" id="add-btn" class="btn btn-success">Add
                                          More</button></td>
                              </tr>
                          </table>
                      </div>
                      </div>
                     
                    
                  </div>
                 
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
  
              
             
  
            </div>
            
          </div>
        
        
    </div>
    
    
@endsection
