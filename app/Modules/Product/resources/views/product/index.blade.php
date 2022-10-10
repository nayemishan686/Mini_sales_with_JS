@extends('Admin::layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product Table</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- Button trigger modal -->
                            <a href="{{ route('product.create') }}">
                                <button type="button" class="btn btn-primary">
                                    Add New
                                </button>
                            </a>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">All Product</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Brand</th>
                                                <th>Category</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $key => $item)
                                                <tr>
                                                    <td>{{ ($product->currentpage() - 1) * $product->perpage() + $key + 1 }}
                                                    </td>
                                                    <td><img src="{{ asset($item->image) }}" height="40" width="40"
                                                            alt="{{ $item->slug }}"></td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->brand_name }}</td>
                                                    <td>{{ $item->category_name }}</td>
                                                    <td>
                                                        @if ($item->quantity > 0)
                                                            <span class="badge badge-success">{{ $item->quantity }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ $item->quantity }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->status }}</td>
                                                    <td>
                                                        <a href="{{ route('product.edit', $item->id) }}"
                                                            class="btn btn-primary edit">Edit</a>
                                                        <a href="{{ route('product.delete', $item->id) }}"
                                                            class="btn btn-danger" id="delete">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        {{ $product->links() }}
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endsection
