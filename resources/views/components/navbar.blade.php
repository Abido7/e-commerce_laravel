<nav class="navbar navbar-expand-lg navbar-dark bg-dark" dir="ltr">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">E-Commerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                        @foreach ($cats as $cat)

                            <li><a class="nav-link"
                                    href="{{ route('category.show', ['category' => $cat->id]) }}">{{ $cat->name() }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link  position-relative" aria-current="page" href="{{ route('order.index') }}">
                            Orders
                            <span
                                class="position-absolute bg-info text-light rounded-circle d-flex justify-content-center align-items-center"
                                style="top: 0px; right: -2px; width: 15px; height: 15px; font-size: 14px;">
                                {{ Auth::user()->orders->count() }}
                            </span>
                        </a>
                    </li>
                    @if (Auth::user()->role->name == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page"
                                href="{{ route('dashboard.home') }}">Dashboard</a>
                        </li>
                    @endif
                @endauth


                @guest
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn nav-link">Login</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn nav-link">Register</button>
                        </form>
                    </li>
                @endguest

                {{-- cart --}}
                @if (session('cart'))
                    @php
                        $total = 0;
                    @endphp
                    @foreach (session('cart') as $id => $details)
                        {{-- {{ dd($details['name']) }} --}}
                        <?php $total += $details['quantity']; ?>
                    @endforeach
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart') }}">
                        <i class="fa fa-cart-plus position-relative fa-2x" aria-hidden="true">
                            @isset($total)
                                <span
                                    class="position-absolute bg-info text-light rounded-circle d-flex justify-content-center align-items-center"
                                    style="top: -6px; right: -10px; width: 20px; height: 20px; font-size: 16px;">
                                    {{ $total }}
                                </span>
                            @endisset
                        </i>
                    </a>
                </li>

                @if (session()->get('lang') == 'en')
                    <li class="nav-item">
                        <form action="{{ route('lang.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn nav-link">ع</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <form action="{{ route('lang.destroy', ['lang' => 'ar']) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn nav-link">EN</button>
                        </form>
                    </li>
                @endif


                @auth
                    <li class="nav-item d-flex align-items-center px-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit " class="btn btn-sm bg-danger rounded p-1">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>
