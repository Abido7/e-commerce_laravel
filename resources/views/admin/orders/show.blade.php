@extends('admin.inc.master')

@section('title')
    Products
@endsection
@section('body')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h1 class="m-0">Order Detail</h1>
                    </div><!-- /.col -->
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col-12 -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="bg-info rounded py-1 text-center">
                                    <h3>User Name</h3>
                                    <p>{{ $order->user->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-info rounded py-1 text-center">
                                    <h3>User Phone</h3>
                                    <p>{{ $order->user->phone }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-info rounded py-1 text-center">
                                    <h3>order status</h3>
                                    <p>{{ $order->status }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-info rounded py-1 text-center">
                                    <h3> Order Amount </h3>
                                    @php
                                        $total = 0;
                                        foreach ($order->products as $product) {
                                            $total += $product->pivot->amount;
                                        }
                                    @endphp
                                    <p>{{ $total }}$</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Product Price</th>
                                        <th>Product Quantity</th>
                                        <th> Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>
                                                <p>{{ $product->name('en') }}</p>
                                            </td>
                                            <td>
                                                <img height="100px" src="{{ asset("uploads/$product->img") }}" />
                                            </td>
                                            <td>
                                                <p>{{ $product->price }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $product->pivot->quantity }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $product->pivot->amount }}$</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('orders.index') }}">Back</a>
                                        </td>
                                        <td colspan="4"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    @endsection
