{{--<!-- Record Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('record_id', 'Record Id:') !!}--}}
{{--{!! Form::number('record_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Group Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('group_id', 'Group Id:') !!}--}}
{{--{!! Form::number('group_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Template Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('template_id', 'Template Id:') !!}--}}
{{--{!! Form::number('template_id', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Name Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('name', 'Name:') !!}--}}
{{--{!! Form::text('name', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Delivery Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('delivery', 'Delivery:') !!}--}}
{{--{!! Form::text('delivery', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Routine Appointment Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('routine_appointment', 'Routine Appointment:') !!}--}}
{{--{!! Form::text('routine_appointment', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Date Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('date', 'Date:') !!}--}}
{{--{!! Form::date('date', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Time Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('time', 'Time:') !!}--}}
{{--{!! Form::text('time', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Timestamp Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('timestamp', 'Timestamp:') !!}--}}
{{--{!! Form::number('timestamp', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Message Field -->--}}
{{--<div class="form-group col-sm-12 col-lg-12">--}}
{{--{!! Form::label('message', 'Message:') !!}--}}
{{--{!! Form::textarea('message', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--<!-- Send To Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('send_to', 'Send To:') !!}--}}
{{--{!! Form::text('send_to', null, ['class' => 'form-control']) !!}--}}
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

{{--<!-- Phones Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('phones', 'Phones:') !!}--}}
{{--{!! Form::text('phones', null, ['class' => 'form-control']) !!}--}}
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

{{--<!-- Status Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('status', 'Status:') !!}--}}
{{--<label class="checkbox-inline">--}}
{{--{!! Form::hidden('status', false) !!}--}}
{{--{!! Form::checkbox('status', '1', null) !!} 1--}}
{{--</label>--}}
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
@php
    $old = old()
@endphp
<campaign-form @if( isset($campaign) ) :model='{{json_encode($campaign)}}' @endif
                @if( isset($old) && count($old) ) :model='{{json_encode($old)}}' @endif
               :records='{!! json_encode($records) !!}'
               :deliveries='{{ json_encode(trans('labels.campaign.deliveries')) }}'
               :routing-appointments='{{json_encode(trans('labels.campaign.routines'))}}'
               :templates='{{json_encode($templates)}}'
               :groups='{{json_encode($groups)}}'
></campaign-form>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('campaigns.index') !!}" class="btn btn-default">Cancel</a>
</div>
