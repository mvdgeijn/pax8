<?php

namespace Mvdgeijn\Pax8\Requests;

use Mvdgeijn\Pax8\Collections\PaginatedCollection;
use Mvdgeijn\Pax8\Responses\Product;

class ProductRequest extends AbstractRequest
{
    /**
     * Returns a paginated list of all your products filtered by optional parameters
     *
     * Check for possible options
     *
     * @link https://docs.pax8.com/api/v1#tag/Products
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

    /**
     * Returns a single product record matching the productId you specify
     *
     * @param string $productId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getProvisioningDetails(string $productId)
    {
        $response = $this->getRequest('/v1/products/' . $productId . '/provision-details');

        if ($response->getStatusCode() == 200)
            return json_decode($response->getBody() );
        else
            return null;
    }

    /**
     * Returns pricing information for a single product
     *
     * @param string $productId
     * @return mixed|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPricing(string $productId)
    {
        $response = $this->getRequest('/v1/products/' . $productId . '/pricing');

        if ($response->getStatusCode() == 200)
            return json_decode($response->getBody() );
        else
            return null;

    }

    /**
     * Returns dependencies for a single product
     *
     * @param string $productId
     * @return mixed|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDependencies(string $productId)
    {
        $response = $this->getRequest('/v1/products/' . $productId . '/dependencies');

        if ($response->getStatusCode() == 200)
            return json_decode($response->getBody() );
        else
            return null;

    }

}
