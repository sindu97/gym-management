<?php

namespace App\Services;

use Twilio\Rest\Client;

class WhatsAppService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendMessage($to, $message)
    {
        $this->client->messages->create(
            "whatsapp:{$to}",
            [
                'from' => env('TWILIO_WHATSAPP_FROM'),
                'body' => $message,
                'mediaUrl' => 'https://pdfobject.com/pdf/sample.pdf'
            ]
        );
    }
}
