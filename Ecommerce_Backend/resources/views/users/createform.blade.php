@extends('layouts.admin')
@section('page_name')
{{ $action }} User
@endsection
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                
            </div>
            <div class="col-md-3" >
                <a href="{{ route('user.index')}}" class="btn btn-warning float-right display-block" style="
                        ">Manage Users</a>
            </div>
        </div>
        </br>
        @include('flash-message')

        <div class="row">
        
            <div class="col-md-12">
             
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">{{ $action }} User</h3>
                </div>
                
                <form action="{{ $action_url}}" method="POST">
                    @csrf
                    @if(isset($user->id))
                     @method('PUT')
                    @endif
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ old('name',isset($user->name)?$user->name:'')}}">
                    </div>

                    <div class="form-group">
                      <label for="email">Email Address</label>
                      <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ old('email',isset($user->email)?$user->email:'')}}">
                    </div>
                    <div class="form-group">
                        <label for="role">Select Role</label>
                       <select name="role" id="role" class="form-control">
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                          
                          @php
                           $role_id_value=old('role',isset($user->role_id)?$user->role_id:'');
                           @endphp
                        <option value="{{ $role->role_id }}" {{$role_id_value==$role->role_id?'selected':''}}>{{ $role->role_name }}</option>
                        @endforeach
                       </select>
                      </div>
                     @if(!isset($user->id))
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                      </div>
                    @endif
                    
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
