<?php

namespace Mvdgeijn\Pax8\Requests;

use Mvdgeijn\Pax8\Collections\PaginatedCollection;
use Mvdgeijn\Pax8\Responses\Subscription;

class SubscriptionRequest extends AbstractRequest
{
    /**
     * Returns a paginated list of all your subscriptions filtered by optional parameters
     *
     * Check https://docs.pax8.com/api/v1#operation/findCompanies for possible
     * options
     *
     * @param array $options
     * @return PaginatedCollection|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(array $options = [] ): ?PaginatedCollection
    {
        $response = $this->getRequest( '/v1/subscriptions', $options );

        if ($response->getStatusCode() == 200)
            return Subscription::createFromBody( $response->getBody() );
        else
            return null;
    }

    /**
     * Returns a single company record matching the companyId you specify
     *
     * @param string $subscriptionId
     * @return Subscription|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $subscriptionId ): ?Subscription
    {
        $response = $this->getRequest('/v1/subscriptions/' . $subscriptionId );

        if ($response->getStatusCode() == 200)
            return Subscription::parse(json_decode( $response->getBody() ) );
        else
            return null;
    }
}
