<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name') !!}
    <span style="color: rgb(255,0,0);">*</span>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

@if(str_contains(\Route::currentRouteAction(), 'edit'))
   <list-contact-editable :contacts="{{json_encode($contacts)}}"></list-contact-editable>
@endif
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('groups.index') !!}" class="btn btn-default">Cancel</a>
</div>