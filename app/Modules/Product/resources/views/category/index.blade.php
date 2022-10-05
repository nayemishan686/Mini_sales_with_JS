@extends('Admin::layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Category Table</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- Button trigger modal -->
                            <a href="{{ route('category.create') }}">
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
                                    <h3 class="card-title">All Category</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Category Name</th>
                                                <th>Brand Name</th>
                                                <th>Category Slug</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($category as $key => $item)
                                                <tr>
                                                    <td>{{ ($category->currentpage()-1) * $category->perpage() + $key + 1 }}</td>
                                                    <td>{{ $item->category_name }}</td>
                                                    <td>{{ $item->brand_name }}</td>
                                                    <td>{{ $item->slug }}</td>
                                                    <td>{{ $item->status }}</td>
                                                    <td>
                                                        <a href="{{route('category.edit',$item->id)}}" class="btn btn-primary edit">Edit</a>
                                                        <a href="{{route('category.delete',$item->id)}}" class="btn btn-danger" id="delete">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        {{ $category->links() }}
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
