@extends('Admin::layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Brands Table</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- Button trigger modal -->
                            <a href="{{ route('brand.index') }}">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#brandModal">
                                    All Brands
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
                                    <h3 class="card-title">Edit Brand</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    {!! Form::model($brand, ['method' => 'POST', 'route' => ['brand.update',$brand->id], 'id' => 'brand']) !!}
                                        @include('Product::brand.form')
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
