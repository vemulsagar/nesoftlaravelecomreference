@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
       $(document).ready(function() {
        $("#example1").DataTable({
            "bPaginate": false,
                "bInfo": false,
        "responsive": false, "lengthChange": false,
        "buttons": [ "csv", "pdf"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        })
    </script>
    <div class="container">
        <div class="float-left my-3 mx-3">
            <a href="{{ route('show.products') }}" class="btn btn-warning float-right" role="button">Back</a>
        </div>
        <div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table" id="example1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Product Name</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Product Category</th>
                        <td>
                            @foreach ($cat as $c)
                                @if ($product->prod_category[0]->cat_id == $c->id)
                                    {{ $c->name }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Product Quantity</th>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                    <tr>
                        <th>Product Price</th>
                        <th> RS.{{ $product->price }}</th>
                    </tr>
                    <tr>
                        <th>Product Images</th>
                        <td>
                            @foreach ($product->images as $image)
                                <img src="{{ asset('/ProductImages/' . $image->image) }}" width=100 height=100 />
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Product Attributes</th>
                        <td>
                            <table class="table">
                                <tr>
                                    <th>Attribute Name</th>
                                    <th>Attribute Value</th>
                                </tr>
                                @foreach ($product->assoc as $assocs)
                                    <tr>
                                        <td>{{ $assocs->attr_name }}</td>
                                        <td>{{ $assocs->arrt_value }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>Product Description</th>
                        <td>{{ $product->description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>

@endsection
