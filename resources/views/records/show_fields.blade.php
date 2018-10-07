<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $record->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $record->name !!}</p>
</div>

<!-- File Field -->
<div class="form-group">
    {!! Form::label('file', 'File:') !!}
    <p>{!! $record->file !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $record->status !!}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{!! $record->created_by !!}</p>
</div>

<!-- Updated By Field -->
<div class="form-group">
    {!! Form::label('updated_by', 'Updated By:') !!}
    <p>{!! $record->updated_by !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $record->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $record->updated_at !!}</p>
</div>

