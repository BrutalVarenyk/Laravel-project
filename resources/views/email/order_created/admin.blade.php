@component('mail::message')

{{ $full_name }}, somebody just make a purchase,

Check it by order {{ $order_id }}

@component('mail::button', ['url' => route('lang.admin.orders.edit', $order_id)])
Go to order edit
@endcomponent

{{ config('app.name') }}
@endcomponent
