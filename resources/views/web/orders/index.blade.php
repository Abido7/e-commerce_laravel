@extends('web.layout.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="h1">Your Orders</h1>
            </div>
        </div>


        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d, M, Y h:m a') }}</td>
                        <td class="d-flex align-items-center justify-content-start">
                            <a href="{{ route('order.show', $order->id) }}"><i class="fa fa-eye"
                                    aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>




    </div>

@endsection
