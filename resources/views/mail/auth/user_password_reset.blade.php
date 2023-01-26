@component('mail::message')
{{ trans('notification.user_password_reset.message') }}
<br/>

@component('mail::button', ['url' => $url, 'color' => 'blue'])
{{ trans('notification.user_password_reset.button_text') }}
@endcomponent

{{ trans('messages.thanks') }},<br>
@endcomponent
