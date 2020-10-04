<?php

return [
    'url' => env('SMS_GATEWAY_URL', 'http://api.veevotech.com/sendsms'),
    'key' => env('SMS_GATEWAY_KEY', null),
    'from' => env('SMS_GATEWAY_FROM', 8583),
];