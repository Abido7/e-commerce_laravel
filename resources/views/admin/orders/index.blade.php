@extends('admin.inc.master')

@section('title')
    Products
@endsection

@section('notification')
    {{-- on click notification get pending orders only --}}
    <div class="notify bg-danger rounded p-1  text-light text-center">New Order Added
    </div>
    <form action="{{ route('orders.index') }}" method="GET">
        <input type="hidden" name="filter[status]" value="{{ 'pending' }}" class="form-control my-1"
            placeholder="User Name">
        <button type="submit" class="btn nav-link  position-relative">
            <i class="far fa-comment"></i>
            <span
                class=" position-absolute bg-danger text-light rounded-circle d-flex justify-content-center align-items-center"
                style="top: 0px; right: 27px; width: 15px; height: 15px; font-size: 14px;">
                {{ $pendingOrderNum }}
            </span>
        </button>
    </form>
@endsection

@section('filter')
    <form action="{{ route('orders.index') }}" class=" py-2 px-1" method="GET">
        <p class="text-light">Filter order</p>

        <input type="text" name="filter[name]" class="form-control my-1" placeholder="User Name">
        <input type="text" name="filter[phone]" class="form-control my-1" placeholder="Phone">

        <select name="filter[status]" class="form-control my-1">
            <option type="text" disabled selected class="form-control my-1">
                Status
            </option>
            @foreach ($enumoptions as $option)
                <option type="text" value="{{ $option }}" class="form-control my-1">
                    {{ $option }}
                </option>
            @endforeach
        </select>

        <div class="form-group d-flex align-items-center">
            <label for="fromDate" class="text-light mr-1">From:</label>
            <input type="date" name="filter[date][from]" class="form-control my-1">
        </div>

        <div class="form-group d-flex align-items-center">
            <label for="fromDate" class="text-light mr-1">To:</label>
            <input type="date" id="toDate" name="filter[date][to]" class="form-control my-1">
        </div>

        <button type="submit" class="btn btn-info mt-2">submit</button>
    </form>
@endsection

@section('body')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h1 class="m-0">Orders</h1>
                    </div><!-- /.col -->
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @include('admin.inc.messages')
                @include('admin.inc.errors')
                <div class="row">
                    <!-- /.col-12 -->
                    <div class="col-12">
                        @if (count($orders) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>User Phone</th>
                                        <th>Status</th>
                                        <th>Ordered At</th>
                                        <th>option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->user->phone }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y h:m a') }}
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <a href="{{ url("dashboard/orders/$order->id") }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>

                                                <button type="button" class="btn text-secondary edit-btn"
                                                    data-toggle="modal" data-target="#edit-order-modal"
                                                    data-order_id="{{ $order->id }}"
                                                    data-status="{{ $order->status }}">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <p class="h3 text-danger">No Results Found</p>
                        @endif

                        @if (app('request')->input('filter'))
                            <a class="btn btn-info" href="{{ route('orders.index') }}">back</a>
                        @endif
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
                <div class="d-flex justify-content-center align-items-center">
                    @if (count($orders) > 0)
                        {{ $orders->links() }}
                    @endif
                </div>
            </div><!-- /.container-fluid -->


        </div>
        <!-- /.content -->

    @endsection
    @section('modal')
        {{-- {{-- edite modal --}}
        <div class="modal fade" id="edit-order-modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit order Status</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="form-order-edit" method="POST">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Current Status</label>
                                            <input type="text" disabled class="form-control status">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label> Status </label>
                                        <select class="form-control" name="status">
                                            @foreach ($enumoptions as $option)
                                                <option class="form-control" value="{{ $option }}">
                                                    {{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit" form="form-profile-edit">update</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            {{-- edit order --}}
            <script>
                $('.edit-btn').click(function(e) {
                    $('.status').attr('value', $(this).attr('data-status'))
                    $('#form-order-edit').
                    attr('action',
                        window.location.origin +
                        '/dashboard/orders/' +
                        $(this).attr('data-order_id'))
                });
                $('.submit').click(function(e) {
                    $('#form-order-edit').submit()
                });
            </script>
            <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
            <script>
                // Enable pusher logging - don't include this in production
                Pusher.logToConsole = true;

                var pusher = new Pusher('ceadcd5bc2d9d8e8310a', {
                    cluster: 'eu'
                });

                var channel = pusher.subscribe('order-added');
                channel.bind('orderAdded', function(data) {
                    $('.notify').fadeIn(500);
                });
            </script>
        </div>
    @endsection
