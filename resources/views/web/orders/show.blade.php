@extends('web.layout.master')

@section('content')
    <div class="container py-5">
        <h1 class="h1 text-center mb-2">Order Details</h1>
        <table class="table table-hover">

            @foreach ($products as $product)
                <tbody>
                    <tr>
                        <th class="bg-secondary text-light w-25">Order ID</th>
                        <td>
                            <p class="mx-2">{{ $order->id }}</p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light w-25">product ID</th>
                        <td>
                            <p class="mx-2">{{ $product->id }}</p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light w-25">Name</th>
                        <td>
                            <p class="mx-2">{{ $product->name() }}</p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light w-25">Description</th>
                        <td>
                            <p class="px-2">
                                {{ $product->description() }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light w-25">Image</th>
                        <td><img class="rounded w-25" src="{{ asset("uploads/$product->img") }}" alt=""></td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light w-25">Order Status</th>
                        <td>
                            <p class="mx-2">{{ $order->status }}</p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light w-25">Quantity</th>
                        <td>
                            <p class="mx-2">{{ $product->pivot->quantity }}</p>
                        </td>
                    </tr>

                    <tr>
                        <th class="bg-secondary text-light w-25">Price</th>
                        <td>
                            <p class="mx-2">{{ $product->price }}$</p>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-secondary text-light w-25">Amount</th>
                        <td>
                            <p class="mx-2">{{ $product->pivot->amount }}$</p>
                        </td>
                    </tr>

                    {{-- @if ($products->lastPage() == request()->query('page'))
                        <tr>
                            <th class="bg-secondary text-light w-25">Total amout for order</th>
                            <td>
                                <p class="mx-2">{{ $total }}$</p>
                            </td>
                        </tr>
                    @endif --}}

                    <tr>
                        <th class="bg-secondary text-light w-25">Option</th>
                        <td class="d-flex justify-content-start align-items-center">
                            @if ($order->status == 'pending')
                                <form action="{{ route('order.destroy', ['order' => $order->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn text-danger">
                                        Cancel Order
                                    </button>
                                </form>
                            @endif
                            <a class="text-decoration-none text-info mx-2 " href="{{ route('order.index') }}">
                                Back
                            </a>

                        </td>
                    </tr>
                </tbody>

            @endforeach
        </table>
        <div class="d-flex justify-content-center align-items-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
