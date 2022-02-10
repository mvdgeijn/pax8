<?php

namespace Mvdgeijn\Pax8\Requests;

use GuzzleHttp\RequestOptions;
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

    /**
     * Get the used access token object
     *
     * @return AccessToken
     */
    public function getAccessToken(): AccessToken
    {
        return $this->accessToken;
    }

    /**
     * Do a GET request on the Pax8 API
     *
     * @param $path
     * @param $query
     * @return ResponseInterface|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getRequest($path, $query = [] ): ?ResponseInterface
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

    /**
     * Do a POST request on the Pax8 API
     *
     * @param $path
     * @param \stdClass $data
     * @return ResponseInterface|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function postRequest($path, \stdClass $data ): ?ResponseInterface
    {
        $client = new Client(['base_uri' => $this->baseUrl, 'timeout' => 2.0]);
        $response = $client->request('POST', $path, [
            'headers' => [
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->accessToken->accessToken
            ],
            RequestOptions::JSON => $data
        ]);

        return $this->handleErrors( $response );
    }

    /**
     * Handle the return errors (if any) on a Pax8 API request (GET and POST)
     *
     * @param ResponseInterface $response
     * @return ResponseInterface|null
     */
    private function handleErrors(ResponseInterface &$response ): ?ResponseInterface
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

    /**
     * Return all errors in a array of strings, or null if no errors
     *
     * @return array|null
     */
    public function getErrors( ): ?array
    {
        return $this->errors;
    }

    /**
     * Returns true of there are any errors, false if no errors at all
     *
     * @return bool
     */
    public function hasErrors(): bool
    {
        return( $this->errors == null );
    }
}
