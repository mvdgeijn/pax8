<?php

namespace Mvdgeijn\Pax8\Requests;

use Mvdgeijn\Pax8\Responses\AccessToken;
use GuzzleHttp\Client;

class AbstractRequest
{
    protected ?string $baseUrl = null;

    protected AccessToken $accessToken;

    public function __construct( AccessToken &$accessToken )
    {
        $this->baseUrl = config('pax8.url.api');

        $this->accessToken = $accessToken;
    }

    protected function getRequest( $path, $query = [] )
    {
        $client = new Client(['base_uri' => config('pax8.url.api'), 'timeout' => 2.0]);
        return $client->request('GET', $path, [
            'headers' => [
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->accessToken->accessToken
            ],
            'query' => $query
        ]);

    }
}
