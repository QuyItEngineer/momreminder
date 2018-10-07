@foreach($settings as $key => $value)
    <div class="form-group col-md-6 col-md-offset-3 col-xs-offset-0 col-xs-12">
        {!! Form::label($key, trans('labels.settings.items')[$key].':') !!}
        @switch($key)
            @case(App\Models\Setting::SETTING_ALLOW_USER_REGISTER)
            @case(App\Models\Setting::SETTING_ALLOW_REMEMBER_ME)
            {!! Form::hidden($key, 0) !!}
            {!! Form::checkbox($key, 1, $value) !!}
            @break
            @case(App\Models\Setting::SETTING_STRIPE_TEST_MODE)
            {!! Form::radio($key, 1, $value == 1) !!} On
            {!! Form::radio($key, 0, $value == 0) !!} Off
            @break
            @case(App\Models\Setting::SETTING_COUNTRY)
            {!! Form::select($key, trans('labels.countries.items'), $value, ['class' => 'form-control']) !!}
            @break
            @default
            {!! Form::text($key, $value, ['class' => 'form-control']) !!}
            @break
        @endswitch
    </div>
@endforeach

<!-- Submit Field -->
<div class="form-group col-md-6 col-md-offset-3 col-xs-offset-0 col-xs-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
