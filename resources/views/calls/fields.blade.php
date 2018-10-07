<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Call Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('call_id', 'Call Id:') !!}
    {!! Form::text('call_id', null, ['class' => 'form-control']) !!}
</div>

<!-- From Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('from_phone', 'From Phone:') !!}
    {!! Form::text('from_phone', null, ['class' => 'form-control']) !!}
</div>

<!-- To Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_phone', 'To Phone:') !!}
    {!! Form::text('to_phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Audio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('audio', 'Audio:') !!}
    {!! Form::text('audio', null, ['class' => 'form-control']) !!}
</div>

<!-- Bot Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bot', 'Bot:') !!}
    {!! Form::number('bot', null, ['class' => 'form-control']) !!}
</div>

<!-- Sentense Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sentense', 'Sentense:') !!}
    {!! Form::text('sentense', null, ['class' => 'form-control']) !!}
</div>

<!-- Event Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('event_type', 'Event Type:') !!}
    {!! Form::text('event_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time', 'Time:') !!}
    {!! Form::text('time', null, ['class' => 'form-control']) !!}
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', 'State:') !!}
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', false) !!}
        {!! Form::checkbox('status', '1', null) !!} 1
    </label>
</div>

<!-- Callback Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('callback', 'Callback:') !!}
    {!! Form::textarea('callback', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('calls.index') !!}" class="btn btn-default">Cancel</a>
</div>
