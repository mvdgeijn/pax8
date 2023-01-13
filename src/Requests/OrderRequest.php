<?php

namespace Mvdgeijn\Pax8\Requests;

use Mvdgeijn\Pax8\Collections\PaginatedCollection;
use Mvdgeijn\Pax8\Responses\Order;

class OrderRequest extends AbstractRequest
{
    /**
     * Returns a paginated list of all your orders filtered by optional parameters
     *
     * Check link for possible options
     *
     * @link https://docs.pax8.com/api/v1#tag/Invoices
     *
     * @param array $options
     * @return PaginatedCollection|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function list(array $options = [] ): ?PaginatedCollection
    {
        $response = $this->getRequest( '/v1/orders', $options );

        if ($response->getStatusCode() == 200)
            return Order::createFromBody( $response->getBody() );
        else
            return null;
    }

    /**
     * Returns a single product record matching the orderId you specify
     *
     * @param string $orderId
     * @return Order|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function get(string $orderId): ?Order
    {
        $response = $this->getRequest('/v1/orders/' . $orderId);

        if ($response->getStatusCode() == 200)
            return Order::parse(json_decode($response->getBody()));
        else
            return null;
    }

    /**
     * Create an order
     *
     * @param \stdClass $options
     * @return mixed|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(\stdClass $options, $isMock = false ): mixed
    {
        $response = $this->postRequest('/v1/orders' . ( $isMock ? "?isMock=1" : "" ), $options );

        if ($response->getStatusCode() == 200)
            return json_decode($response->getBody());

        return null;
    }
}
