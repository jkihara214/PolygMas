<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GeminiService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GOOGLE_AI_API_KEY');
        $this->client = new Client([
            'base_uri' => 'https://generativelanguage.googleapis.com/v1beta/',
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function sendMessage($message)
    {
        try {
            $response = $this->client->post("models/gemini-pro:generateContent?key={$this->apiKey}", [
                'json' => [
                    'contents' => [
                        ['parts' => [['text' => $message]]],
                    ],
                ],
            ]);

            $result = json_decode($response->getBody(), true);
            return $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
        } catch (GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
