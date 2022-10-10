<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'col-form-label']) !!}<span class="text-danger"> *</span>

            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Name']) !!}
            <span class="text-danger"> {!! $errors->first('name') !!}</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('email', 'E-mail', ['class' => 'col-form-label']) !!}<span class="text-danger"> *</span>

            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Email']) !!}
            <span class="text-danger"> {!! $errors->first('email') !!}</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('phone', 'Phone Number', ['class' => 'col-form-label']) !!}<span class="text-danger"> *</span>

            {!! Form::number('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Phone']) !!}
            <span class="text-danger"> {!! $errors->first('phone') !!}</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}<span class="text-danger"> *</span>

            {!! Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'], $customer->status?? 'active', ['class' => 'form-control'])!!}
            <span class="text-danger"> {!! $errors->first('status') !!}</span>
        </div>
    </div>
</div>
<div class="form-group">
    {!!Form::submit('Save',['class' => 'btn btn-success float-right'])!!}
</div>
