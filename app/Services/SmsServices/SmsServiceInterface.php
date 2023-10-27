<?php

namespace App\Services\SmsServices;

interface SmsServiceInterface {
    public function sendSms($to, $message);
}
