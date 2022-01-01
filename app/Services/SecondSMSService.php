<?php

namespace App\Services;

class SecondSMSService
{
    public static function sendSmsViaNexom(String $phoneNumber,  String $from = "App", String $msg)
    {
        \Nexmo::message()->send([
            'to'   => $phoneNumber,
            'from' => $from,
            'text' => $msg
        ]);
    }
}
