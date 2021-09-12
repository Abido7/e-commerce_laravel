@extends('admin.inc.master')

@section('title')
    Products
@endsection

@section('filter')
    <form action="{{ route('products.index') }}" class=" py-2 px-1" method="GET">

        <p class="text-light">Filter Products</p>

        <select name="filter[category_id]" class="form-control">
            <option selected disabled class="form-control">
                Category
            </option>
            @forelse ($categories as $cat)
                <option value="{{ $cat->id }}" class="form-control">{{ $cat->name('en') }}</option>
            @empty

                <p>fff </p>
            @endforelse
        </select>

        <input type="text" name="filter[product_name]" class="form-control my-1" placeholder="product Name">

        <input type="number" name="filter[price][min]" class="form-control my-1" placeholder="minPrice">

        <input type="number" name="filter[price][max]" class="form-control my-1" placeholder="maxPrice">

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
                        <h1 class="m-0">Products</h1>
                    </div><!-- /.col -->
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                        <button type="button" class="btn btn-primary float-sm-right mx-2" data-toggle="modal"
                            data-target="#add-modal">
                            Add Product
                        </button>
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
                        @if (count($products) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name(en)</th>
                                        <th>Name(ar)</th>
                                        <th>price</th>
                                        <th>Orders</th>
                                        <th>Active</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name('en') }}</td>
                                            <td>{{ $product->name('ar') }}</td>
                                            <td>{{ $product->price }}$</td>
                                            <td>{{ $product->orders->count() }}</td>
                                            <td>
                                                @if ($product->is_active)
                                                    <form action="{{ url("dashboard/product/deactivate/$product->id") }}"
                                                        class="status-form" method="POST">
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <span>yes</span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ url("dashboard/product/activate/$product->id") }}"
                                                        class="status-form" method="POST">
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <span>no</span>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td class="d-flex align-items-center justify-content-start">
                                                <a href="{{ url("dashboard/products/$product->id") }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                {{-- edit modal --}}
                                                <button type="button" class="btn text-warning edit-btn" data-toggle="modal"
                                                    data-target="#edit-profile-modal"
                                                    data-cat_id="{{ $product->category_id }}"
                                                    data-id="{{ $product->id }}"
                                                    data-name_en="{{ $product->name('en') }}"
                                                    data-name_ar="{{ $product->name('ar') }}"
                                                    data-desc_en="{{ $product->description('en') }}"
                                                    data-desc_ar="{{ $product->description('ar') }}"
                                                    data-price="{{ $product->price }}"
                                                    data-pices_no="{{ $product->pices_no }}">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </button>
                                                {{-- /edit modal --}}

                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn text-danger">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <p class="h3 text-danger">No Results Found</p>
                        @endif


                        @if (Route::is('filter'))
                            <a href="{{ url('/dashboard/products') }}">back</a>
                        @endif
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
                <div class="d-flex justify-content-center align-items-center">
                    @if (count($products) > 0)
                        {{ $products->links() }}
                    @endif
                </div>
            </div><!-- /.container-fluid -->



            <script>
                // edit data
                $('.edit-btn').click(function(e) {
                    let id = $(this).attr('data-id');
                    $('.id').attr('value', id);

                    let cat_id = $(this).attr('data-cat_id');
                    $('.cat_id').attr('value', cat_id);

                    let name_ar = $(this).attr('data-name_ar');
                    $('.name_ar').attr('value', name_ar);

                    let name_en = $(this).attr('data-name_en');
                    $('.name_en').attr('value', name_en);

                    let desc_en = $(this).attr('data-desc_en');
                    $('.desc_en').attr('value', desc_en);

                    let desc_ar = $(this).attr('data-desc_ar');
                    $('.desc_ar').attr('value', desc_ar);

                    let price = $(this).attr('data-price');
                    $('.price').attr('value', price);

                    let pices_no = $(this).attr('data-pices_no');
                    $('.pices_no').attr('value', pices_no);
                });
            </script>
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
                                <h4 class="modal-title">Add New Category</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="modal-form" method="POST" enctype="multipart/form-data"
                                    action="{{ route('products.store') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> name(en) </label>
                                                    <input type="text" name="name_en" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> name(ar) </label>
                                                    <input type="text" name="name_ar" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Description(en) </label>
                                                    <input type="text" name="desc_en" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Description(ar) </label>
                                                    <input type="text" name="desc_ar" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Pices_no </label>
                                                    <input type="number" name="pices_no" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select name="category_id" class="form-control">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" class="form-control">
                                                                {{ $category->name() }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> price </label>
                                                    <input type="number" name="price" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Image</label>
                                                <input class="form-control form-control-md" name="img" type="file">
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

            {{-- {{-- edite modal --}}
            <div class="edit-profile-modal">
                <div class="modal fade" id="edit-profile-modal" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Product Info</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('dashboard/products/1') }}" id="form-profile-edit" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name='id' class="id">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> name(en) </label>
                                                    <input type="text" name="name_en" class="form-control name_en">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> name(ar) </label>
                                                    <input type="text" name="name_ar" class="form-control name_ar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Description(en) </label>
                                                    <input type="text" name="desc_en" class="form-control desc_en">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Description(ar) </label>
                                                    <input type="text" name="desc_ar" class="form-control desc_ar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> Pices_no </label>
                                                    <input type="number" name="pices_no" class="form-control pices_no">
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select name="category_id" class="form-control category_id">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" class="form-control">
                                                                {{ $category->name() }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label> price </label>
                                                    <input type="number" name="price" class="form-control price">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Image</label>
                                                <input class="form-control form-control-md" name="img" type="file">
                                            </div>
                                        </div>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary form-profile-edit"
                                    form="form-profile-edit">update</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
        </div>
    @endsection
