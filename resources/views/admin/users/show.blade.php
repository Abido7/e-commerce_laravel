@extends('admin.inc.master')

@section('title')
    dashboard
@endsection

@section('body')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $user->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li> --}}
                            <li class="breadcrumb-item active">{{ $user->name }}</li>
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
                                {{-- name --}}

                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                {{-- email --}}
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>

                                <tr>
                                    <th>Orders</th>
                                    <td>{{ $user->orders->count() }}</td>
                                </tr>

                                <tr>
                                    <th>Joined At</th>
                                    <td>{{ Carbon\Carbon::parse($user->created_at)->format('m/d/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Add Order</th>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info " data-toggle="modal"
                                            data-target="#add-modal">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>

                        </table>


                    </div>
                    <!-- /.col-md-6 -->

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->

        </div>
        <!-- /.content -->

    @endsection
    @section('modal')
        <div class="modal-content">
            <!-- add modal -->
            <div class="add-modal">
                <div class="modal fade" id="add-modal" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add New Order</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="modal-form" method="POST" action="{{ route('orders.store') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>Product name </label>
                                                <select name="product_id" class="form-control">
                                                    @foreach ($products as $product)
                                                        <option class="form-control" value="{{ $product->id }}">
                                                            {{ $product->name() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Quantity </label>
                                                    <input type="number" min="1" name="quantity" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" form="modal-form">Save changes</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
        </div>
    @endsection
