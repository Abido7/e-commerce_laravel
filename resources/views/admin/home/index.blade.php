@extends('admin.inc.master')

@section('title')
    users
@endsection

@section('body')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Home</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <!-- /.col-12 -->
                        <div class="col-4">
                            <div class="bg-secondary rounded">
                                <p class="h4 m-0 p-2">Users ({{ $users }})*</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-secondary rounded">
                                <p class="h4 m-0 p-2">Products ({{ $products }})*</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-secondary rounded">
                                <p class="h4 m-0 p-2">total income {{ $income }}$</p>
                            </div>
                        </div>

                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            {!! $orderChart->container() !!}

                            <script src="{{ $orderChart->cdn() }}"></script>

                            {{ $orderChart->script() }}
                        </div>

                        <div class="col-md-6">
                            <h2 class="h2 text-center mt-5">Top 5 Saled This Month</h2>

                            <table class="table table">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Orders</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="table-secondary">
                                    @foreach ($maxproduct as $product)
                                        <tr>
                                            {{-- {{ dd($product) }} --}}
                                            <td>{{ $product->product_id }}</td>
                                            <td>{{ $product->orders }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->amount }}$</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->

            </div>
        </div>

        <!-- /.content -->

    @endsection
