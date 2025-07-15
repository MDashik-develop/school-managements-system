<?php

namespace App\Traits;

/**
 * Trait to send SMS via BulkSMSBD.net API.
 */
trait SmsSender
{
    /**
     * Send an SMS.
     *
     * @param string $number
     * @param string $message
     * @return string|null
     */
    public function sendSms(string $number, string $message): ?string
    {
        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = env('SMS_API_KEY');
        $senderid = env('SMS_SENDER_ID');

        $data = [
            "api_key"  => $api_key,
            "senderid" => $senderid,
            "number"   => $number,
            "message"  => $message
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}