@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example1').DataTable({
            "bPaginate": false,
                "bInfo": false,
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'csv',
                    title: 'Orders List PDF',
                    exportOptions: {
                        columns: [0,1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    title: 'Orders List PDF',
                    exportOptions: {
                        columns: [0,1, 2, 3, 4]
                    }
                }
            ]
        });
    })
</script>
    <div class="container">
        <h1>Orders Placed Details Here</h1>
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <table class="table table-striped" id="example1">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Mobile No</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($users as $user) --}}
                    @if (!empty($useraddress) && $useraddress->count())
                        @foreach ($useraddress as $useradd)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $useradd->email }}</td>
                                <td>{{ $useradd->first_name }}&nbsp;{{ $useradd->last_name }}</td>
                                <td>{{ $useradd->mobile_no }}</td>
                                <td>{{ $useradd->address1 }}</td>
                                <td>
                                    <a href="/order/orderinfo/{{ $useradd->id }}" class="btn btn-warning">View</a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center">There is no data.</td>
                        </tr>
                    @endif
                {{-- @endforeach --}}
            </tbody>
        </table>

    </div>
    <div>
        {{ $useraddress->links() }}
    </div>
    </div>
    <style>
        .w-5 {
            display: none;
        }

    </style>
@endsection
