@extends('layouts.admin')
@section('page_name')
Manage Brands
@endsection
@section('content')
   
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                
            </div>
            <div class="col-md-3" >
                <a href="{{ route('brands.create')}}" class="btn btn-warning float-right display-block" style="
                        ">Add Brands</a>
            </div>
        </div></br>
        @include('flash-message')
        <table class="table table-striped datatable_class" id="example1">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                   <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                

                @if ($data->total()>0)
                    @foreach ($data as $row)
                      
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td><a href="{{asset('storage/media/'.$row->image)}}" target="_blank"><img src="{{asset('storage/media/'.$row->image)}}" style="width:50px;height:50px;" alt="no image"></a></td>
                                
                                
                                <td>
                                    <a href="{{route('brands.edit',$row->id)}}" class="btn btn-success">Edit</a>
                                    <form action="{{ route('brands.destroy', $row->id) }}" method="POST">
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
    @if ($data->links()->paginator->hasPages())
    {{ $data->links() }}
    @endif
    <style>
        .w-5 {
            display: none;
        }

    </style>
@endsection
