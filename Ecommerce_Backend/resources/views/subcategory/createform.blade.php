@extends('layouts.admin')
@section('page_name')
{{ $action }} Subcategory
@endsection
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                
            </div>
            <div class="col-md-3" >
                <a href="{{ route('user.index')}}" class="btn btn-warning float-right display-block" style="
                        ">Manage Subcategory</a>
            </div>
        </div>
        </br>
        @include('flash-message')

        <div class="row">
        
            <div class="col-md-12">
             
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">{{ $action }} Subcategory</h3>
                </div>
                
                <form action="{{ $action_url}}" method="POST">
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
                      <label for="description">Description</label>
                      <textarea name="description" id="description" cols="10" rows="3" class="form-control">{{ old('description',isset($data->description)?$data->description:'')}}</textarea>
                      
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
