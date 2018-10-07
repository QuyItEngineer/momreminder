<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $activity->id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $activity->user_id !!}</p>
</div>

<!-- Activity Field -->
<div class="form-group">
    {!! Form::label('activity', 'Activity:') !!}
    <p>{!! $activity->activity !!}</p>
</div>

<!-- Module Field -->
<div class="form-group">
    {!! Form::label('module', 'Module:') !!}
    <p>{!! $activity->module !!}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{!! $activity->created_by !!}</p>
</div>

<!-- Update By Field -->
<div class="form-group">
    {!! Form::label('update_by', 'Update By:') !!}
    <p>{!! $activity->update_by !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $activity->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $activity->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $activity->updated_at !!}</p>
</div>

