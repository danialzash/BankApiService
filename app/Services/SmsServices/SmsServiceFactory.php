<?php

namespace App\Services\SmsServices;

use Exception as SmsProviderException;

class SmsServiceFactory
{
    /**
     * @throws SmsProviderException
     */
    public static function create(): SmsServiceInterface
    {
        $smsProvider = config('sms.provider');

        return match ($smsProvider) {
            'KavehNegar' => new KavehNegarSmsService(),
            'Ghasedak' => new GhasedakSmsService(),
            'default' => throw new SmsProviderException("Unsupported SMS provider: ${smsProvider}")
        };
    }
}
