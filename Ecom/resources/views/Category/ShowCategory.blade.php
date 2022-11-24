@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.deletecat').click(function(e) {
                var cid = $(this).attr('cid');
                if (confirm("Delete Category?")) {
                    $.ajax({
                        url: "{{ url('/category/deletecategory') }}",
                        method: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            cid: cid
                        },
                        success: function(response) {
                            window.location.href = "/category/showcategory";
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    })
                }
            })
            setTimeout(function() {
                $('#successMessage').fadeOut('fast');
            }, 3000);
            $('#example1').DataTable({
                "bPaginate": false,
                "bInfo": false,
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                dom: 'Blfrtip',
                buttons: [{
                        extend: 'csv',
                        title: 'Category PDF',
                        exportOptions: {
                            columns: [0,1, 2]
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Category PDF',
                        exportOptions: {
                            columns: [0,1, 2]
                        }
                    }
                ]
            });
        })
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1>Categories Here</h1>
            </div>
            <div class="col-md-3">
                <a href="/category/addcategory" class="btn btn-warning float-right display-block" style="
                ">Add Category</a>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success" id="successMessage">{{ Session::get('success') }}</div>
        @endif
        <table class="table table-striped" id="example1">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($category) && $category->count())
                    @foreach ($category as $cat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->description }}</td>
                            <td>
                                <a href="/category/editcategory/{{ $cat->id }}" class="btn btn-success">Edit</a>
                                <a href="javascript:void(0)" cid={{ $cat->id }}
                                    class="btn btn-danger deletecat">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">There is no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div>
            {{ $category->links() }}
        </div>
    </div>
    <style>
        .w-5 {
            display: none;
        }

    </style>
@endsection
