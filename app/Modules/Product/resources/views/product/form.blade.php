<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name','Product Name', ['class' => 'col-form-label']) !!}<span class="text-danger">*</span>
            {!! Form::text('name',null,['class' => 'form-control', 'placeholder' => 'Enter Product Name']) !!}
            <span class="text-danger">{!! $errors->first('name') !!}</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('brand_id','Brand Name',['class' => 'col-form-label']) !!}<span class="text-danger">*</span>
            {!! Form::select('brand_id',$brands, null, ['class' => 'form-control']) !!}
            <span class="text-danger">{!! $errors->first('brand_id') !!}</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('category_id','Category Name',['class' => 'col-form-label']) !!}<span class="text-danger">*</span>
            {!! Form::select('category_id',$categories, null, ['class' => 'form-control']) !!}
            <span class="text-danger">{!! $errors->first('category_id') !!}</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}<span class="text-danger"> *</span>
            {!! Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'], $product->status?? 'active', ['class' => 'form-control'])!!}
            <span class="text-danger"> {!! $errors->first('status') !!}</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('selling_price','Selling Price', ['class' => 'col-form-label']) !!}<span class="text-danger">*</span>
            {!! Form::number('selling_price',null,['class' => 'form-control', 'placeholder' => 'Enter Selling price']) !!}
            <span class="text-danger">{!! $errors->first('selling_price') !!}</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('discount_price','Discount Price', ['class' => 'col-form-label']) !!}<span class="text-danger">*</span>
            {!! Form::number('discount_price',null,['class' => 'form-control', 'placeholder' => 'Enter Discount price']) !!}
            <span class="text-danger">{!! $errors->first('discount_price') !!}</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('quantity','Quantity', ['class' => 'col-form-label']) !!}<span class="text-danger">*</span>
            {!! Form::number('quantity',null,['class' => 'form-control', 'placeholder' => 'Enter Product Quantity']) !!}
            <span class="text-danger">{!! $errors->first('quantity') !!}</span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description','Product Description', ['class' => 'col-form-label']) !!}<span class="text-danger">*</span>
            {!! Form::textarea('description',null,['class' => 'form-control', 'id' => 'summernote', 'placeholder' => 'Enter Discount price']) !!}
            <span class="text-danger">{!! $errors->first('description') !!}</span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('image','Product Image', ['class' => 'col-form-label']) !!}<span class="text-danger">*</span>
            {!! Form::file('image',['class' => 'form-control']) !!}
            <span class="text-danger">{!! $errors->first('image') !!}</span>
        </div>
    </div>


</div>
<div class="form-group">
    {!!Form::submit('Save',['class' => 'btn btn-success float-right'])!!}
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

// AJAX for childcategory data multiple dependency
$("#brand_id").change(function() {
            var id = $(this).val();
            $.ajax({
                url: "{{ url('/product/get-category/') }}/" + id,
                type: 'get',
                success: function(data) {
                    $('select[name="category_id"]').empty();
                    $.each(data, function(key, data) {
                        $('select[name="category_id"]').append('<option value="' + data
                            .id + '">' + data.name + '</option>');
                    });
                }
            });
        });
</script>