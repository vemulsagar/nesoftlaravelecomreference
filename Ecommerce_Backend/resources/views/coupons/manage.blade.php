@extends('layouts.admin')
@section('page_name')
Manage Coupons
@endsection
@section('content')
   
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                
            </div>
            <div class="col-md-3" >
                <a href="{{ route('coupons.create')}}" class="btn btn-warning float-right display-block" style="
                        ">Add Coupons</a>
            </div>
        </div></br>
        @include('flash-message')
        <table class="table table-striped datatable_class" id="example1">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Code</th>
                    <th scope="col">Value</th>
                   <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                

                @if ($data->total()>0)
                    @foreach ($data as $row)
                      
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->code }}</td>
                                <td>{{ $row->value }}</td>
                                
                                
                                <td>
                                    <a href="{{route('coupons.edit',$row->id)}}" class="btn btn-success">Edit</a>
                                    <form action="{{ route('coupons.destroy', $row->id) }}" method="POST">
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
