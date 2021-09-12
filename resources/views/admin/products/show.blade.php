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
                        <h1 class="m-0">Products</h1>
                    </div><!-- /.col -->
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                            <li class="breadcrumb-item active">{{ $product->name() }}</li>
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
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name(en)</th>
                                    <td>{{ $product->name('en') }}</td>
                                </tr>
                                <tr>
                                    <th>Name(ar)</th>
                                    <td>{{ $product->name('ar') }}</td>
                                </tr>
                                <tr>
                                    <th>Description(en)</th>
                                    <td>{{ $product->description('en') }}</td>
                                </tr>
                                <tr>
                                    <th>Description(ar)</th>
                                    <td>{{ $product->description('ar') }}</td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        <img width="150px" src="{{ asset("uploads/$product->img") }}" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <th>price</th>
                                    <td>{{ $product->price }}$</td>
                                </tr>

                                <tr>
                                    <th>pices no.</th>
                                    <td>{{ $product->pices_no }}</td>
                                </tr>

                                <tr>
                                    <th>Orders</th>
                                    <td>{{ $product->orders->count() }}</td>
                                </tr>
                                <tr>
                                    <th>Active</th>
                                    <td>{{ $product->is_active }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('products.index') }}">Back</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    @endsection
