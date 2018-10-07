<!-- File Field -->
<div class="form-group col-md-6">
    <audio-record name="file" upload-url="{!! route('records.upload') !!}"></audio-record>
</div>

<!-- Name Field -->
<div class="form-group col-md-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', trans('labels.status.items'), null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('records.index') !!}" class="btn btn-default">Cancel</a>
</div>
