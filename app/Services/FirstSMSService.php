<?php

namespace App\Services;

class FirstSMSService
{
    public static function sendSmsViaNexom(String $phoneNumber, $from = "APP", String $msg)
    {
        \Nexmo::message()->send([
            'to'   => $phoneNumber,
            'from' => $from,
            'text' => $msg
        ]);
    }
}
