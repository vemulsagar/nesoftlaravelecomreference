@extends('layouts.admin')
@section('page_name')
Manage Users
@endsection
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                
            </div>
            <div class="col-md-3" >
                <a href="{{ route('user.create')}}" class="btn btn-warning float-right display-block" style="
                        ">Add Users</a>
            </div>
        </div></br>
        @include('flash-message')
        <table class="table table-striped datatable_class" id="example1">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                   <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                

                @if ($users->total()>0)
                    @foreach ($users as $user)
                      
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{$user->roles->role_name}}
                                </td>
                                
                                <td>
                                    <a href="{{route('user.edit',$user->id)}}" class="btn btn-success">Edit</a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-1">Delete</button>
                                    </form>
                                </td>
                            </tr>

                       
                    @endforeach
                    
                @else
                    <tr>
                        <td colspan="5" class="text-center">There is no data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    @if ($users->links()->paginator->hasPages())
    {{ $users->links() }}
    @endif
    <style>
        .w-5 {
            display: none;
        }

    </style>
@endsection
