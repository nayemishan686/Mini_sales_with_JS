<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'col-form-label']) !!}<span class="required"> *</span>

            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Brand Name']) !!}
            <span class="text-danger"> {!! $errors->first('name') !!}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}<span class="required"> *</span>

            {!! Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'], $brand->status?? 'inactive', ['class' => 'form-control'])!!}
            <span class="text-danger"> {!! $errors->first('status') !!}</span>
        </div>
    </div>
</div>
<div class="form-group">
    {!!Form::submit('Save',['class' => 'btn btn-success float-right'])!!}
</div>
