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
                            <a href="{{ route('product.index') }}">
                                <button type="button" class="btn btn-primary">
                                    All Product
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
                                    <h3 class="card-title">Edit Product</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    {!! Form::model($product, ['method' => 'PATCH', 'files'=> true, 'route' => ['product.update',$product->id], 'id' => 'category']) !!}
                                        @include('Product::product.form')
                                        <input type="hidden" id="file"  name="old_image" value="{{ $product->image  }}" placeholder="">
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endsection
