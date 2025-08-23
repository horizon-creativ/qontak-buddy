<?php

namespace Horizondoxa\QontakBuddy\Core;

use GuzzleHttp\Client;

class QontakClient
{
    protected $client;
    protected $accessToken;
    protected $baseUrl;

    public function __construct($accessToken)
    {
        $this->client = new Client([
            'verify' => false
        ]);
        $this->accessToken = $accessToken;
        $this->baseUrl = 'https://service-chat.qontak.com/api/open/v1/';
    }

    public function request($method, $endpoint, array $options = [])
    {
        $options['headers']['Authorization'] = 'Bearer ' . $this->accessToken;
        $options['headers']['Accept'] = 'application/json';

        if (!empty($options['json'])) {
            $options['headers']['Content-Type'] = 'application/json';
        }

        $response = $this->client->request($method, $this->baseUrl . $endpoint, $options);

        return json_decode($response->getBody()->getContents(), true);
    }
}
