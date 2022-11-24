@extends('layouts.admin')
@section('page_name')
{{ $action }} Coupon
@endsection
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                
            </div>
            <div class="col-md-3" >
                <a href="{{ route('coupons.index')}}" class="btn btn-warning float-right display-block" style="
                        ">Manage Coupons</a>
            </div>
        </div>
        </br>
        @include('flash-message')

        <div class="row">
        
            <div class="col-md-12">
             
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">{{ $action }} Coupon</h3>
                </div>
                
                <form action="{{ $action_url}}" method="POST">
                    @csrf
                    @if(isset($data->id))
                     @method('PUT')
                    @endif
                  <div class="card-body">
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{ old('title',isset($data->title)?$data->title:'')}}">
                    </div>

                    <div class="form-group">
                      <label for="code">Code</label>
                      <input type="text" class="form-control" name="code" id="code" placeholder="Enter Code" value="{{ old('code',isset($data->code)?$data->code:'')}}">
                    </div>

                    <div class="form-group">
                      <label for="value">Value</label>
                      <input type="text" class="form-control" name="value" id="value" placeholder="Enter Value" value="{{ old('value',isset($data->value)?$data->value:'')}}">
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
