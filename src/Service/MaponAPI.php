<?php

namespace Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class MaponAPI
{
    private ?string $url = null;
    private ?string $key = null;
    private Client $client;

    function __construct()
    {
        $this->url = getenv('MAPON_URL');
        $this->key = getenv('MAPON_KEY');
        $this->client = new Client(['verify' => false]);
    }

    public function get(int $unit_id): string
    {
        $requestQuery = http_build_query([
            'key' => $this->key,
            'from' => '2022-01-27T22:00:00Z',
            'till' => '2022-01-28T22:00:00Z',
            'unit_id' => $unit_id,
        ]);
        $request = null;
        try {
            $request = $this->client->request(
                'GET',
                $this->url . 'route/list.json?' . $requestQuery,
            );
        }
        catch (GuzzleException $e) {
        }
        return (string) $request?->getBody();
    }
}
