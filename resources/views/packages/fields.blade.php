<!-- Name Field -->
<div class="form-group  col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Sort Order Field -->
<div class="form-group col-sm-12">
    {!! Form::label('sort_order', 'Sort Order:') !!}
    {!! Form::number('sort_order', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Credit Field -->
<div class="form-group col-sm-12">
    {!! Form::label('credit', 'Credit:') !!}
    {!! Form::number('credit', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('packages.index') !!}" class="btn btn-default">Cancel</a>
</div>
