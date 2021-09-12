@extends('web.layout.master')

@section('content')
    <table id="cart" class="table table-hover mt-3">

        @if (session('success'))
            <p class="muted text-success text-center py-2">{{ session('success') }}</p>
        @endif
        <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%">actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>

            @if (session('cart'))
                @foreach (session('cart') as $id => $details)
                    <?php $total += $details['price'] * $details['quantity']; ?>
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{ asset('uploads/' . $details['img']) }}"
                                        width="100" height="100" class="img-responsive" /></div>
                                <div class="col-sm-9">
                                    @php
                                        $name = json_decode($details['name'], true);
                                        $lang = App::getLocale();
                                    @endphp
                                    <h4 class="nomargin">
                                        {{ $name[$lang] }}
                                    </h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price" class="price" value="{{ $details['price'] }}">
                            ${{ $details['price'] }}</td>

                        <td data-th="Quantity">
                            <input type="number" value="{{ $details['quantity'] }}" data-id="{{ $id }}" min="1"
                                class="form-control quantity" />
                        </td>


                        <td data-th="Subtotal" class="text-center Subtotal">
                            ${{ $details['price'] * $details['quantity'] }}
                        </td>
                        <td class="actions" data-th="">
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>

        <tfoot class="w-100">
            <tr>
                <td class="d-flex">
                    <a href="{{ url('/') }}" class="btn btn-warning mx-2">
                        <i class="fa fa-angle-left"></i>
                        Continue Shopping
                    </a>
                    @auth

                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <button class="btn btn-success">Submit Order</button>
                        </form>

                    @endauth
                    @guest
                        <p class="muted text-danger m-0 p-0 d-flex justify-content-center align-items-center">
                            <span class="px-2"> Join Us to Continue Order!</span>
                            <a class="muted text-decoration-none" href="{{ route('register') }}">Register</a>
                        </p>
                    @endguest

                </td>
                <td colspan="2"></td>
                <td class="hidden-xs text-center"><strong>Total ${{ $total }}</strong></td>
                <td colspan="1"></td>
            </tr>
        </tfoot>

        <script type="text/javascript">
            $(".quantity").change(function(e) {
                e.preventDefault();
                var ele = $(this);
                $.ajax({
                    url: '{{ url('/cart/update-product/') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-id"),
                        quantity: ele.val(),
                    },
                    success: function(response) {}
                });
            });
            $(".remove-from-cart").click(function(e) {
                e.preventDefault();
                var ele = $(this);
                if (confirm("Are you sure")) {
                    $.ajax({
                        url: '{{ url('/cart/delete-product/') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.attr("data-id")
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });
        </script>
    </table>
@endsection
