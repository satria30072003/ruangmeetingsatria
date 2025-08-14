<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Http;

class WhatsappHelper
{
    public static function sendMessage($target, $message)
    {
        $token = env('WHATSAPP_API_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.fonnte.com/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $target,
                'message' => $message,
            ],
            CURLOPT_HTTPHEADER => [
                "Authorization: $token"
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}