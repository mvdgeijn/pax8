<?php

namespace Mvdgeijn\Pax8\Requests;

use Mvdgeijn\Pax8\Collections\PaginatedCollection;
use Mvdgeijn\Pax8\Responses\Product;

class ProductRequest extends AbstractRequest
{
    /**
     * Returns a paginated list of all your products filtered by optional parameters
     *
     * Check https://docs.pax8.com/api/v1#tag/Products for possible
     * options
     *
     * @param array $options
     * @return PaginatedCollection|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(array $options = [] ): ?PaginatedCollection
    {
        $response = $this->getRequest( '/v1/products', $options );

        if ($response->getStatusCode() == 200)
            return Product::createFromBody( $response->getBody() );
        else
            return null;
    }

    /**
     * Returns a single product record matching the productId you specify
     *
     * @param string $productId
     * @return Product|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $productId): ?Product
    {
        $response = $this->getRequest('/v1/products/' . $productId);

        if ($response->getStatusCode() == 200)
            return Product::parse(json_decode($response->getBody()));
        else
            return null;
    }
}
