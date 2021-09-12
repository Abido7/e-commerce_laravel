@extends('web.layout.master')

@section('content')

    <div class="content">

        {{-- slider --}}
        <div id="carouselExampleIndicators" class="carousel slide bg-dark vh-100" style="max-height: 91vh"
            data-bs-ride="carousel">
            <div class="carousel-indicators mb-0">

                @foreach ($products as $prod)

                    <button type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->iteration == 1 ? 'active' : '' }}"
                        aria-current="true" aria-label="Slide{{ $loop->index }}"></button>
                @endforeach

            </div>
            <div class="carousel-inner">

                @foreach ($products as $product)
                    <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }} position-relative">
                        <div class="overlay bg-dark d-flex align-items-center justify-content-center"
                            style="max-height: 91vh;opacity: 0.6">
                            <img src="{{ asset("uploads/$product->img") }}" class="w-100" alt="...">
                            <div class="py-2 bg-dark position-absolute d-flex flex-column align-items-center"
                                style="opacity: .5;">

                                <h1 class="text-white text-uppercase">{{ $product->name() }}</h1>

                                <p class="text-white w-50 m-auto muted h4 text-center">
                                    {{ \Illuminate\Support\Str::limit($product->description(), 100, $end = '...') }}
                                </p>

                                <h4 class="text-bold mt-4 text-white">
                                    Price @money($product->price)$
                                </h4>

                                <a class="btn btn-danger text-white"
                                    href="{{ route('product.show', ['product' => $product->id]) }}">
                                    Show Product
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        {{-- /slider --}}

        {{-- features --}}
        <div class="container py-5">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <h2 class="h1 text-bold">Features</h2>
            </div>
            <div class="row">
                @foreach ($features as $feature)
                    <div class="col-md-4">
                        <div class="card mr-2 my-2">

                            <div class="card-img">
                                <img class="w-100" src="{{ asset("uploads/$feature->img") }}" alt="">
                            </div>
                            <div class="card-header  text-uppercase d-flex justify-content-between">
                                <h3>{{ $feature->name() }}</h3>

                                @if ($feature->pices_no > 0)

                                    <form action="{{ route('addToCart', [$feature->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn">
                                            <i class="fa fa-cart-plus h3" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-danger">Expired :(</span>
                                @endif

                            </div>
                            <div class="card-body my-0">
                                <p> {{ \Illuminate\Support\Str::limit($feature->description(), 100, $end = '...') }} </p>
                                <p class="h5 my-0 text-danger">Price: @money( $feature->price )$</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <a class="btn btn-info"
                                    href="{{ route('product.show', ['product' => $feature->id]) }}">
                                    Show Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        {{-- features --}}
        <div class=" bg-secondary py-3">
            <div class="container text-light">
                Copy Right Reserved &copy; to ....
            </div>
        </div>



    </div>
@endsection
