 <!DOCTYPE html>
<html>
<head>
    <title>Error occured</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container text-center mt-4">
    <h1 class="my-4">This is the error page.</h1>
    <h2 class=" text-info">Something went wrong</h2>
    @if (session('error'))
        {{-- <div class="alert alert-danger" role="alert"> --}}
            {{ session('error') }}
        {{-- </div> --}}
    @endif

</div>
</body>
</html>

{{-- @extends('layouts.app')

@section('content')

    <div class="conontainer">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">{{ __('Error') }}</div>

                <div class="card-body">
                    <h1>Something went wrong</h1>
                    <b class="text-center">Error</b>

                </div>
            </div>
        </div>
    </div>
@endsection --}}
