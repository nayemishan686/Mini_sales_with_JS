@extends('Admin::layouts.admin')

@section('admin_content')
    @push('css')
        <style>
            div.dt-buttons {
                display: none;
            }
        </style>
    @endpush
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header bg-gray">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">POS</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- Button trigger modal -->
                            <li>Date: {{ date('d/m/y') }}</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row mb-2">
                                <div class="col-8">
                                    <h3>Customer Information</h3>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                        data-target="#addModal">
                                        Add New
                                    </button>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <h6 for="cust_id">Select Customer</h6>
                                        <select class="form-control submitable" name="cust_id" id="cust_id">
                                            <option value="" selected disabled>Please Select a Customer</option>
                                            @foreach ($customer as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}
                                                    ({{ $row->phone }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <h6 for="number">Phone Number:</h6>
                                        <input type="text" name="number" id="number" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <h6 for="email">E-mail:</h6>
                                        <input type="email" name="email" id="email" class="form-control" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                        </div>
                    </div>
                    {{-- action="{{ route('customer.store') }}" method="POST" id="add_form" --}}
                    <form id="add_form">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Customer Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter Customer name">
                            </div>
                            <div class="form-group">
                                <label for="phone">Customer Phone</label>
                                <input type="number" class="form-control" name="phone" id="phone"
                                    placeholder="Enter Customer Phone No">
                            </div>
                            <div class="form-group">
                                <label for="gmail">Customer E-mail</label>
                                <input type="email" class="form-control" name="gmail" id="gmail"
                                    placeholder="Enter Customer E-mail">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="Submit" class="btn btn-primary btn-submit"> <span class="d-none loader"><i
                                        class="fas fa-spinner"></i> Loading..</span> <span class="submit_btn"> Submit
                                </span> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @push('scripts')
        <script>
            // Searchable Dropdown
            $(document).ready(function() {
                $('#cust_id').select2();
            });

            $(document).ready(function() {
                // To select customer
                $("#cust_id").change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "{{ url('/pos/get-data/') }}/" + id,
                        type: 'GET',
                        dataType: "json",
                        success: function(data) {
                            $("#number").val(data.phone);
                            $("#email").val(data.email);
                        }
                    });
                });
            })
        </script>

        {{-- Add with ajax --}}
        <script type="text/javascript">
            $(document).ready(function() {
                $(".btn-submit").click(function(e) {
                    e.preventDefault();
                    var _token = $("input[name='_token']").val();
                    var name = $("input[name='name']").val();
                    var phone = $("input[name='phone']").val();
                    var email = $("input[name='gmail']").val();
                    var status = $("select[name='status']").val();
                    $.ajax({
                        url: "{{ route('customer.ajax.store') }}",
                        type: 'POST',
                        data: {
                            _token: _token,
                            name: name,
                            phone: phone,
                            email: email,
                            status: status
                        },
                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                // toastr.success(data);
                                $("#addModal").modal('hide');
                                $('select[name="cust_id"]').append('<option value="' + data
                                .id + '" selected>' + data.name + '</option>');
                                $("#number").val(data.phone);
                                $("#email").val(data.email);
                                $('#add_form')[0].reset();

                            } else {
                                printErrorMsg(data.error);
                            }
                        }
                    });

                });

                function printErrorMsg(msg) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display', 'block');
                    $.each(msg, function(key, value) {
                        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                    });
                }
            });
        </script>
    @endpush
@endsection
