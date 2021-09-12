@extends('web.layout.master')

@section('content')

    <div class="container my-5">

        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset("uploads/$product->img") }}" class="w-100" alt="">
            </div>
            <div class="col-md-6">
                <div>
                    <h1 class=" h1">{{ $product->name() }}</h1>
                    <h6 class=" h5">Category: {{ $product->category->name() }}</h6>
                    <p class="lead">{{ $product->description() }}</p>
                    <p class="lead">Price @money($product->price)$</p>

                    @if ($product->pices_no > 0)

                        <form action="{{ route('addToCart', [$product->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info text-dark">
                                Add To Card
                                <i class="fa fa-cart-plus h3" aria-hidden="true"></i>
                            </button>
                        </form>

                    @else
                        <span class="text-danger">Expired :(</span>

                    @endif
                </div>
            </div>
        </div>

    </div>

@endsection
