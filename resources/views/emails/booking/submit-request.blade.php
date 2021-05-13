{{-- @component('mail::message')
# Introduction


Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}

@component('mail::message')
# Thank you <strong>{{$data['name']}}</strong> for Booking a Move!, you can track your moving using Your Booking Number given below:

<strong>Booking Number:</strong> {{ $data['booking_number'] }}

@endcomponent
