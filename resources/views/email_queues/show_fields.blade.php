<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $emailQueue->id !!}</p>
</div>

<!-- To Email Field -->
<div class="form-group">
    {!! Form::label('to_email', 'To Email:') !!}
    <p>{!! $emailQueue->to_email !!}</p>
</div>

<!-- Subject Field -->
<div class="form-group">
    {!! Form::label('subject', 'Subject:') !!}
    <p>{!! $emailQueue->subject !!}</p>
</div>

<!-- Message Field -->
<div class="form-group">
    {!! Form::label('message', 'Message:') !!}
    <p>{!! $emailQueue->message !!}</p>
</div>

<!-- Alt Message Field -->
<div class="form-group">
    {!! Form::label('alt_message', 'Alt Message:') !!}
    <p>{!! $emailQueue->alt_message !!}</p>
</div>

<!-- Max Attempts Field -->
<div class="form-group">
    {!! Form::label('max_attempts', 'Max Attempts:') !!}
    <p>{!! $emailQueue->max_attempts !!}</p>
</div>

<!-- Attempts Field -->
<div class="form-group">
    {!! Form::label('attempts', 'Attempts:') !!}
    <p>{!! $emailQueue->attempts !!}</p>
</div>

<!-- Success Field -->
<div class="form-group">
    {!! Form::label('success', 'Success:') !!}
    <p>{!! $emailQueue->success !!}</p>
</div>

<!-- Date Published Field -->
<div class="form-group">
    {!! Form::label('date_published', 'Date Published:') !!}
    <p>{!! $emailQueue->date_published !!}</p>
</div>

<!-- Last Attempt Field -->
<div class="form-group">
    {!! Form::label('last_attempt', 'Last Attempt:') !!}
    <p>{!! $emailQueue->last_attempt !!}</p>
</div>

<!-- Date Sent Field -->
<div class="form-group">
    {!! Form::label('date_sent', 'Date Sent:') !!}
    <p>{!! $emailQueue->date_sent !!}</p>
</div>

<!-- Csv Attachment Field -->
<div class="form-group">
    {!! Form::label('csv_attachment', 'Csv Attachment:') !!}
    <p>{!! $emailQueue->csv_attachment !!}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{!! $emailQueue->created_by !!}</p>
</div>

<!-- Updated By Field -->
<div class="form-group">
    {!! Form::label('updated_by', 'Updated By:') !!}
    <p>{!! $emailQueue->updated_by !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $emailQueue->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $emailQueue->updated_at !!}</p>
</div>

