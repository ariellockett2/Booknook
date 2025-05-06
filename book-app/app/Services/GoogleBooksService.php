<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleBooksService
{
    protected $baseUrl = 'https://www.googleapis.com/books/v1/volumes';

    public function search($query = 'fiction', $apiKey)
    {
        $response = Http::get($this->baseUrl, [
            'q' => $query,
            'key' => $apiKey,
            'maxResults' => 40,
        ]);

        return $response->successful() ? $response->json()['items'] ?? [] : [];
    }

}
