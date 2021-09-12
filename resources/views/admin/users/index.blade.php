@extends('admin.inc.master')

@section('title')
    users
@endsection

@section('filter')
    <form action="{{ route('users.index') }}" class=" py-2 px-1" method="GET">
        <p class="text-light">Filter Users</p>
        <input type="text" name="filter[phone]" class="form-control my-1" placeholder="User Phone">

        <button type="submit" class="btn btn-info mt-2">Find</button>
    </form>
@endsection


@section('body')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users</h1>
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

                <div class="row">

                    <!-- /.col-12 -->
                    <div class="col-12">
                        @if (count($users) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Active</th>
                                        <th>Is Admin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                @if ($user->is_active)
                                                    <form action="{{ url("dashboard/user/deactivate/$user->id") }}"
                                                        method="POST" id="status-form">
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <span>yes</span>
                                                        </button>
                                                    </form>

                                                @else
                                                    <form action="{{ url("dashboard/user/activate/$user->id") }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <span>no</span>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->role->name == 'admin')

                                                    <form action="{{ url("/dashboard/user/demote/$user->id") }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <span>yes</span>
                                                        </button>
                                                    </form>

                                                @else

                                                    <form action="{{ url("/dashboard/user/promote/$user->id") }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <span>no</span>
                                                        </button>
                                                    </form>


                                                @endif

                                            </td>
                                            <td class="d-flex align-items-center">
                                                {{-- show user --}}
                                                <a href="{{ url("dashboard/users/$user->id") }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                {{-- delete user --}}
                                                <form action="{{ url("/dashboard/users/$user->id") }}" method="POST"
                                                    id="delete-user-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button form="delete-user-form" type="submit" class="btn text-danger">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <p class="h2 text-center text-danger">No Results Founded</p>
                        @endif
                        @if (app('request')->input('filter'))
                            <a class="btn btn-info" href="{{ route('orders.index') }}">back</a>
                        @endif


                    </div>
                    <!-- /.col-md-6 -->


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    @endsection
