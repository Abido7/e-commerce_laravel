@extends('web.layout.master')

@section('content')

    <div class="content">

        {{-- products --}}
        <div class="container py-5">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <h2 class="h1 text-bold">{{ $category->name() }} Products</h2>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mr-2 my-2">

                            <div class="card-img">
                                <img class="w-100" src="{{ asset("uploads/$product->img") }}" alt="">
                            </div>
                            <div class="card-header  text-uppercase d-flex justify-content-between">
                                <h3>{{ $product->name() }}</h3>

                                <form action="{{ route('addToCart', [$product->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn">
                                        <i class="fa fa-cart-plus h3" aria-hidden="true"></i>
                                    </button>
                                </form>

                            </div>
                            <p class="card-body my-0">
                                {{ \Illuminate\Support\Str::limit($product->description(), 100, $end = '...') }}
                            </p>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <span class="h5 my-0 text-danger">Price: @money( $product->price )$</span>
                                <a class="btn btn-info" href="{{ route('product.show', ['product' => $product->id]) }}">
                                    Show Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        {{-- products --}}
        <div class=" bg-secondary py-3">
            <div class="container text-light">
                Copy Right Reserved &copy; to ....
            </div>
        </div>

        {{-- scripts add to cart --}}


    </div>
@endsection
