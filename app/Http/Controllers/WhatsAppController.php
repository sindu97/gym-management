<?php

namespace App\Http\Controllers;

use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    public function sendWhatsAppMessage()
    {
        $to = '+919639603764';  // The recipient's WhatsApp number
        $message = 'message hum mein';  // The message content

        $this->whatsAppService->sendMessage($to, $message);

        return response()->json(['status' => 'Message sent successfully']);
    }
}
