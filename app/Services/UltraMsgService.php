<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UltraMsgService
{
    protected $instanceId;
    protected $token;

    public function __construct()
    {
        $this->instanceId = config('services.ultramsg.instance_id');
        $this->token = config('services.ultramsg.token');
    }

    public function sendWhatsAppMessage($to, $message)
    {
        $url = "https://api.ultramsg.com/{$this->instanceId}/messages/chat";

        $response = Http::asForm()->post($url, [
            'token' => $this->token,
            'to' => $to,
            'body' => $message,
        ]);

        // Optional: Log for admin dashboard analytics
        Log::info('UltraMsg Response', [
            'to' => $to,
            'message' => $message,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return $response->successful();
    }
}
