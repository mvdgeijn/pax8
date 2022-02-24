<?php

namespace Mvdgeijn\Pax8\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Mvdgeijn\Pax8\Pax8;
use Mvdgeijn\Pax8\Events\Pax8AccessTokenCreatedEvent;

class AccessTokenRequest
{
    private ?Pax8 $pax8 = null;

    /**
     * @throws GuzzleException
     */
    public function __construct(Pax8 $pax8 = null )
    {
        if( $pax8 )
            $this->pax8 = $pax8;

        if( $pax8 == null || $pax8->isExpired() )
            $this->accessToken = $this->getAccessToken();
    }

    /**
     * @throws GuzzleException
     */
    public function getAccessToken( bool $renew = false ): ?Pax8
    {
        if( $this->pax8 == null || $this->pax8->isExpired() || $renew ) {
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

            if ($response->getStatusCode() == 200) {
                $pax8 = Pax8::createFromBody($response->getBody());

                Pax8AccessTokenCreatedEvent::dispatch( $pax8 );

                return $pax8;
            } else {
                return null;
            }
        }

        return $this->pax8;
    }
}

