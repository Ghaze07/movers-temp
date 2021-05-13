{{-- @component('mail::message')
# Introduction


Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}

@component('mail::message')
# Hey! <strong>{{$data['name']}}</strong> Your Move request has been approved, our representative will approach you soon, you can track your moving using Your Booking Number given below:

<strong>Estimated Cost:</strong> Rs. {{ $data['estimated_cost'] }}<br>
<strong>Booking Number:</strong> {{ $data['booking_number'] }}

@endcomponent
