<?php

namespace App\Services;

use GuzzleHttp\Client;

class ImageGenerationService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
        ]);
    }

    public function generateImage($prompt)
    {
        try {
            $response = $this->client->request('POST', 'images/generations', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'prompt' => $prompt,
                    'n' => 1,
                    'size' => '1024x1024',
                    'model'=>'dall-e-3'
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
