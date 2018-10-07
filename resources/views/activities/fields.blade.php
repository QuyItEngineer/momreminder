<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Activity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activity', 'Activity:') !!}
    {!! Form::text('activity', null, ['class' => 'form-control']) !!}
</div>

<!-- Module Field -->
<div class="form-group col-sm-6">
    {!! Form::label('module', 'Module:') !!}
    {!! Form::text('module', null, ['class' => 'form-control']) !!}
</div>

<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', 'Created By:') !!}
    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Update By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('update_by', 'Update By:') !!}
    {!! Form::number('update_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('activities.index') !!}" class="btn btn-default">Cancel</a>
</div>
