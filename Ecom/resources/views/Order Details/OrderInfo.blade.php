@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#successMessage').fadeOut('fast');
            }, 3000);
            $("#example1").DataTable({
                "bPaginate": false,
                "bInfo": false,
                "responsive": false,
                "lengthChange": false,
                "buttons": ["csv", "pdf"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        })
    </script>
    <div class="table-responsive">
        @if (Session::has('status'))
            <div class="alert alert-success" id="successMessage">{{ Session::get('status') }}</div>
        @endif
        <table class="table" id="example1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Order Id</th>
                    <td>{{ $useraddress->orderdetail->id }}</td>
                </tr>
                <tr>
                    <th>Order Status</th>
                    <td>
                        <form action="{{route('update.status')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$useraddress->orderdetail->id}}" name="orderdtlid"/>
                            <input type="hidden" value="{{$useraddress->id}}" name="userdtlid"/>
                            <div class="row">
                            <div class="col-md-3">
                                <select class="form-control" id="category" name="status">
                                    <!-- foreach render types  -->
                                    <option value="{{$useraddress->orderdetail->status}}" selected >{{$useraddress->orderdetail->status}}</option>
                                    @if ($useraddress->orderdetail->status == "PENDING")
                                        <option value="DISPATCHED">DISPATCHED</option>
                                        <option value="DELIVERED">DELIVERED</option>
                                    @elseif ($useraddress->orderdetail->status == "DISPATCHED")
                                        <option value="PENDING">PENDING</option>
                                        <option value="DELIVERED">DELIVERED</option>
                                    @else
                                        <option value="PENDING">PENDING</option>
                                        <option value="DISPATCHED">DISPATCHED</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-info" value="Update Status"/>
                            </div>
                            </div>

                        </form>
                    </td>
                </tr>
                <tr>
                    <th>Products</th>
                    <td>
                        <table>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>quantity</th>
                                <th>total</th>
                            </tr>
                            @foreach ($products as $product)
                                @foreach ($useraddress->userorder as $userord)
                                    <tr>
                                        @if ($userord->product_id == $product->id)
                                            <td><img src="{{ asset('/ProductImages/' . $product->images[0]->image) }}"
                                                    class="card-img-top" alt="Asset_img" width=100 height=100>
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                {{ $userord->product_quantity }}
                                            </td>
                                            <td>{{ $product->price * $userord->product_quantity }}</td>
                                    </tr>
                                @endif

                            @endforeach
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Cart Subtotal</th>
                                <td>{{ $useraddress->orderdetail->cart_sub_total }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Coupon Applied</th>
                                <td>
                                    @if ($useraddress->couponused)
                                        @foreach ($coupons as $coupon)
                                            @if ($useraddress->couponused->coupon_id == $coupon->id)
                                <td> {{ $coupon->value }}</td>
                                <td>{{ $coupon->code }}</td>
                                @endif
                                @endforeach
                            @else
                                Not applied
                                @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>Shipping Cost</th>
                    <td>{{ $useraddress->orderdetail->shipping_cost }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>Total</th>
                    <td>{{ $useraddress->orderdetail->total }}</td>
                </tr>
        </table>
        </td>
        </tr>
        </tbody>
        </table>

        <a href="/order/orderdetails" class="btn btn-warning my-4">Back</a>
    </div>
@endsection
