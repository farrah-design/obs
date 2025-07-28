<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UltraMsgService
{
    protected $apiKey;
    protected $instanceId;

    public function __construct()
    {
        $this->apiKey = config('services.ultramsg.api_key');
        $this->instanceId = config('services.ultramsg.instance_id');
    }

    /**
     * Send a WhatsApp message
     */
    public function sendMessage(string $to, string $message)
    {
        $response = Http::post(config('services.ultramsg.api_url') . "/messages/chat", [
            'token' => $this->apiKey,
            'to' => $to, // Format: "14155552671" (no +)
            'body' => $message,
        ]);

        return $response->json();
    }

    /**
     * Send an image with a caption
     */
    public function sendImage(string $to, string $imageUrl, string $caption = '')
    {
        $response = Http::post("https://api.ultramsg.com/{$this->instanceId}/messages/image", [
            'token' => $this->apiKey,
            'to' => $to,
            'image' => $imageUrl,
            'caption' => $caption,
        ]);

        return $response->json();
    }

    // Add more methods for documents, buttons, etc.
}