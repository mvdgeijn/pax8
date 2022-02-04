<?php

namespace Mvdgeijn\Pax8\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Mvdgeijn\Pax8\Responses\AccessToken;

class AccessTokenRequest
{
    private ?AccessToken $accessToken = null;

    /**
     * @throws GuzzleException
     */
    public function __construct(AccessToken $accessToken = null )
    {
        if( $accessToken )
            $this->accessToken = $accessToken;

        if( $accessToken == null || $accessToken->isExpired() )
            $this->accessToken = $this->getAccessToken();
    }

    /**
     * @throws GuzzleException
     */
    public function getAccessToken(): ?AccessToken
    {
        if( $this->accessToken == null || $this->accessToken->isExpired() ) {
            $path = '/oauth/token';

            $client = new Client(['base_uri' => config('pax8.url.login'), 'timeout' => 2.0]);
            $response = $client->request('POST', $path, [
                'headers' => [
                    'content-type' => 'application/json'
                ],
                'json' => [
                    'client_id' => config('pax8.client.id'),
                    'client_secret' => config('pax8.client.secret'),
                    'audience' => 'api://p8p.client',
                    'grant_type' => 'client_credentials'
                ]
            ]);

            if ($response->getStatusCode() == 200)
                return AccessToken::createFromBody($response->getBody());
            else
                return null;
        }

        return $this->accessToken;
    }
}

