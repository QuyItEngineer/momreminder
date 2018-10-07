{{--<!-- Name Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('name', 'Name:') !!}--}}
{{--{!! Form::text('name', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Message Field -->--}}
{{--<div class="form-group col-sm-12 col-lg-12">--}}
{{--{!! Form::label('message', 'Message:') !!}--}}
{{--{!! Form::textarea('message', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Send Type Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('send_type', 'Send Type:') !!}--}}
{{--{!! Form::text('send_type', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Bot Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('bot', 'Bot:') !!}--}}
{{--<label class="checkbox-inline">--}}
{{--{!! Form::hidden('bot', false) !!}--}}
{{--{!! Form::checkbox('bot', '1', null) !!} 1--}}
{{--</label>--}}
{{--</div>--}}

{{--<!-- Media Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('media', 'Media:') !!}--}}
{{--{!! Form::text('media', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Voice Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('voice', 'Voice:') !!}--}}
{{--{!! Form::text('voice', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Record Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('record_id', 'Record Id:') !!}--}}
{{--{!! Form::number('record_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Status Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('status', 'Status:') !!}--}}
{{--{!! Form::text('status', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Created By Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('created_by', 'Created By:') !!}--}}
{{--{!! Form::number('created_by', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Updated By Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('updated_by', 'Updated By:') !!}--}}
{{--{!! Form::number('updated_by', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<template-form @if(isset($template)) :model="{{json_encode($template)}}" @endif
    :records="{{json_encode($records)}}">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('templates.index') !!}" class="btn btn-default">Cancel</a>
    </div>
</template-form>
