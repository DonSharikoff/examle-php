<?php

namespace App\Services;

use Illuminate\Support\Collection;
use jcobhams\NewsApi\NewsApi;

class NewsService
{

    public function __construct(
        private NewsApi $client
    ) {}

    public function getLatestNews(): Collection {
        $response = $this->client->getEverything('code');
        $response = json_decode(json_encode($response), true);
        return collect($response['articles']);
    }
}