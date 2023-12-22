<?php

use Twilio\Rest\Client;

function sendSms($to, $message)
{
    $sid = config('services.twilio.sid');
    $token = config('services.twilio.auth_token');
    $twilioNumber = config('services.twilio.phone_number');

    $client = new Client($sid, $token);

    $client->messages->create(
        $to,
        [
            'from' => $twilioNumber,
            'body' => $message,
        ]
    );
}
