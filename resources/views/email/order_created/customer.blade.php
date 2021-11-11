@component('mail::message')
# Introduction

Hello, {{ $user_fn }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thank you, for  purchase in our store<br>
With regards, {{ config('app.name') }} administration
@endcomponent
