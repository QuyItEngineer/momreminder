@component('mail::message')
# This is only test mail

@component('mail::button', ['url' => config('app.url')])
Home
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
