@extends('layouts.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
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
                        title: 'Contact Details PDF',
                        exportOptions: {
                            columns: [0,1, 2, 3,4]
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Contact Details PDF',
                        exportOptions: {
                            columns: [0,1, 2, 3,4]
                        }
                    }
                ]
            });
        })
    </script>
    <div class="container">
        <h1 class="mb-3">Contact Form Details</h1>
        @if (Session::has('success'))
            <div class="alert alert-success" id="successMessage">{{ Session::get('success') }}</div>
        @endif

        <table class="table table-striped" id="example1">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($contactus) && $contactus->count())

                    @foreach ($contactus as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->emai }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>
                                @if ($contact->status==0)
                                <a href="/contact/replycontact/{{$contact->id}}" class="btn btn-primary">Reply</a>
                                @else
                                <span class="text-primary">Replied</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">There is no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>
    <div>
        {{ $contactus->links() }}
    </div>
    </div>
    <style>
        .w-5 {
            display: none;
        }

    </style>
@endsection
