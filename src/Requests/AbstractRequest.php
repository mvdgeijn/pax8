<?php

namespace Mvdgeijn\Pax8\Requests;

use Mvdgeijn\Pax8\Responses\AccessToken;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class AbstractRequest
{
    protected ?string $baseUrl = null;

    protected AccessToken $accessToken;

    protected ?array $errors = null;

    public function __construct( AccessToken &$accessToken )
    {
        $this->baseUrl = config('pax8.url.api');

        $this->accessToken = $accessToken;
    }

    protected function getRequest( $path, $query = [] ): ?ResponseInterface
    {
        $client = new Client(['base_uri' => $this->baseUrl, 'timeout' => 2.0]);
        $response = $client->request('GET', $path, [
            'headers' => [
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->accessToken->accessToken
            ],
            'query' => $query
        ]);

        return $this->handleErrors( $response );
    }

    protected function postRequest( $path, array $data ): ?ResponseInterface
    {
        $client = new Client(['base_uri' => $this->baseUrl, 'timeout' => 2.0]);
        $response = $client->request('POST', $path, [
            'headers' => [
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->accessToken->accessToken
            ],
            'form_params' => $data
        ]);

        return $this->handleErrors( $response );
    }

    private function handleErrors( ResponseInterface &$response ): ?ResponseInterface
    {
        if( $response->getStatusCode() !== 200 ) {
            $this->errors = null;

            $data = json_decode($response->getBody());

            if ($data !== null) {
                switch ($response->getStatusCode()) {
                    case 400:
                    case 401:
                        $this->errors = [$data->error . ": " . $data->error_description];
                        break;
                    case 404:
                    case 422:
                        $this->errors = $data->errors;
                        break;
                }
            }

            return null;
        }

        return $response;
    }

    public function getErrors( ): ?array
    {
        return $this->errors;
    }
}
