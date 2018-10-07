<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('message_id', 'Message Id:') !!}
    {!! Form::text('message_id', null, ['class' => 'form-control']) !!}
</div>

<!-- From Field -->
<div class="form-group col-sm-6">
    {!! Form::label('from', 'From:') !!}
    {!! Form::text('from', null, ['class' => 'form-control']) !!}
</div>

<!-- To Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to', 'To:') !!}
    {!! Form::text('to', null, ['class' => 'form-control']) !!}
</div>

<!-- Text Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('text', 'Text:') !!}
    {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
</div>

<!-- Media Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('media', 'Media:') !!}
    {!! Form::textarea('media', null, ['class' => 'form-control']) !!}
</div>

<!-- Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time', 'Time:') !!}
    {!! Form::text('time', null, ['class' => 'form-control']) !!}
</div>

<!-- Fallback Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fallback_url', 'Fallback Url:') !!}
    {!! Form::text('fallback_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Skip Mms Carrier Validation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('skip_mms_carrier_validation', 'Skip Mms Carrier Validation:') !!}
    {!! Form::text('skip_mms_carrier_validation', null, ['class' => 'form-control']) !!}
</div>

<!-- Direction Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direction', 'Direction:') !!}
    {!! Form::text('direction', null, ['class' => 'form-control']) !!}
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', 'State:') !!}
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
</div>

<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', 'Created By:') !!}
    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_by', 'Updated By:') !!}
    {!! Form::number('updated_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('messages.index') !!}" class="btn btn-default">Cancel</a>
</div>
