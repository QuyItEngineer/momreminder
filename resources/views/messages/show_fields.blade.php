<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $message->id !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $message->user_id !!}</p>
</div>

<!-- Message Id Field -->
<div class="form-group">
    {!! Form::label('message_id', 'Message Id:') !!}
    <p>{!! $message->message_id !!}</p>
</div>

<!-- From Field -->
<div class="form-group">
    {!! Form::label('from', 'From:') !!}
    <p>{!! $message->from !!}</p>
</div>

<!-- To Field -->
<div class="form-group">
    {!! Form::label('to', 'To:') !!}
    <p>{!! $message->to !!}</p>
</div>

<!-- Text Field -->
<div class="form-group">
    {!! Form::label('text', 'Text:') !!}
    <p>{!! $message->text !!}</p>
</div>

<!-- Media Field -->
<div class="form-group">
    {!! Form::label('media', 'Media:') !!}
    <p>{!! $message->media !!}</p>
</div>

<!-- Time Field -->
<div class="form-group">
    {!! Form::label('time', 'Time:') !!}
    <p>{!! $message->time !!}</p>
</div>

<!-- Fallback Url Field -->
<div class="form-group">
    {!! Form::label('fallback_url', 'Fallback Url:') !!}
    <p>{!! $message->fallback_url !!}</p>
</div>

<!-- Skip Mms Carrier Validation Field -->
<div class="form-group">
    {!! Form::label('skip_mms_carrier_validation', 'Skip Mms Carrier Validation:') !!}
    <p>{!! $message->skip_mms_carrier_validation !!}</p>
</div>

<!-- Direction Field -->
<div class="form-group">
    {!! Form::label('direction', 'Direction:') !!}
    <p>{!! $message->direction !!}</p>
</div>

<!-- State Field -->
<div class="form-group">
    {!! Form::label('state', 'State:') !!}
    <p>{!! $message->state !!}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{!! $message->created_by !!}</p>
</div>

<!-- Updated By Field -->
<div class="form-group">
    {!! Form::label('updated_by', 'Updated By:') !!}
    <p>{!! $message->updated_by !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $message->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $message->updated_at !!}</p>
</div>

