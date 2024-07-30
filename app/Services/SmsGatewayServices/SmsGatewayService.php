<?php

namespace App\Services\SmsGatewayServices;

use App\Services\SmsGatewayServices\SmsGatewayServiceInterface;
use Illuminate\Support\Facades\Http;

class SmsGatewayService implements SmsGatewayServiceInterface
{


    static function sendOtp(string | int $to, string $code)
    {
        try {
            Http::sms()->withQueryParameters([
                'text' => __('sms-templates.otp', ['code' => $code]),
                'to' => "216$to",
            ])->get('sendsms');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
