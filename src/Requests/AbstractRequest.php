<?php

namespace Mvdgeijn\Pax8\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Mvdgeijn\Pax8\Pax8;
use Psr\Http\Message\ResponseInterface;

class AbstractRequest
{
    protected ?string $baseUrl = null;

    protected Pax8 $pax8;

    protected ?array $errors = null;

    public function __construct(Pax8 &$pax8 )
    {
        $this->baseUrl = config('pax8.url.api');

        $this->pax8 = $pax8;
    }

    /**
     * Get the used access token object
     *
     * @return Pax8
     */
    public function getPax8(): Pax8
    {
        return $this->pax8;
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
        if( $this->pax8->isExpired() )
            $this->pax8->renew();

        $client = new Client(['base_uri' => $this->baseUrl, 'timeout' => 10]);

        $retries = 2;
        while( $retries > 0 )
        {
            $response = $client->request('GET', $path, [
                'headers' => [
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->pax8->accessToken
                ],
                'query' => $query
            ]);

            // If returned status is successful (or not equal 401/Unauthorized), don't retry
            if( $response->getStatusCode() != 401 )
                break;

            $this->pax8->renew();
            $retries--;
        }

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
        return $this->doRequest( 'POST', $path, $data );
    }

    /**
     * Do a PUT request on the Pax8 API
     *
     * @param $path
     * @param \stdClass $data
     * @return ResponseInterface|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function putRequest($path, \stdClass $data ): ?ResponseInterface
    {
        return $this->doRequest( 'PUT', $path, $data );
    }

    /**
     * Do a DELETE request on the Pax8 API
     *
     * @param $path
     * @param \stdClass $data
     * @return ResponseInterface|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function deleteRequest($path, \stdClass $data ): ?ResponseInterface
    {
        return $this->doRequest( 'DELETE', $path, $data );
    }

    /**
     * Handle PUT or POST request on the Pax8 API
     *
     * @param string $method
     * @param $path
     * @param \stdClass $data
     * @return ResponseInterface|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function doRequest(string $method, $path, \stdClass $data ): ?ResponseInterface
    {
        if( $this->pax8->isExpired() )
            $this->pax8->renew();

        $client = new Client(['base_uri' => $this->baseUrl, 'timeout' => 60]);

        $retries = 2;
        while( $retries > 0 ) {
            $response = $client->request($method, $path, [
                'headers' => [
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->pax8->accessToken
                ],
                RequestOptions::JSON => $data
            ]);

            // If returned status is successful (or not equal 401/Unauthorized or 404/Not found), don't retry
            if( in_array( $response->getStatusCode(), [200,204,401,404] ) )
                break;

            $this->pax8->renew();
            $retries--;
        }

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
        if( ! in_array( $response->getStatusCode(), [200,204] ) ) {
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
