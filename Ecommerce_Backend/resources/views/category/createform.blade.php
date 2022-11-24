@extends('layouts.admin')
@section('page_name')
{{ $action }} Category
@endsection
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                
            </div>
            <div class="col-md-3" >
                <a href="{{ route('category.index')}}" class="btn btn-warning float-right display-block" style="
                        ">Manage Category</a>
            </div>
        </div>
        </br>
        @include('flash-message')

        <div class="row">
        
            <div class="col-md-12">
             
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">{{ $action }} Category</h3>
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
