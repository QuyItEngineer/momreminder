<!-- To Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_email', 'To Email:') !!}
    {!! Form::text('to_email', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', 'Subject:') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
</div>

<!-- Alt Message Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('alt_message', 'Alt Message:') !!}
    {!! Form::textarea('alt_message', null, ['class' => 'form-control']) !!}
</div>

<!-- Max Attempts Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_attempts', 'Max Attempts:') !!}
    {!! Form::number('max_attempts', null, ['class' => 'form-control']) !!}
</div>

<!-- Attempts Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attempts', 'Attempts:') !!}
    {!! Form::number('attempts', null, ['class' => 'form-control']) !!}
</div>

<!-- Success Field -->
<div class="form-group col-sm-6">
    {!! Form::label('success', 'Success:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('success', false) !!}
        {!! Form::checkbox('success', '1', null) !!} 1
    </label>
</div>

<!-- Date Published Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_published', 'Date Published:') !!}
    {!! Form::date('date_published', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Attempt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_attempt', 'Last Attempt:') !!}
    {!! Form::date('last_attempt', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Sent Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_sent', 'Date Sent:') !!}
    {!! Form::date('date_sent', null, ['class' => 'form-control']) !!}
</div>

<!-- Csv Attachment Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('csv_attachment', 'Csv Attachment:') !!}
    {!! Form::textarea('csv_attachment', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('emailQueues.index') !!}" class="btn btn-default">Cancel</a>
</div>
