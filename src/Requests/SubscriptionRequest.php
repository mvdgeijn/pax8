<?php

namespace Mvdgeijn\Pax8\Requests;

use GuzzleHttp\Exception\GuzzleException;
use Mvdgeijn\Pax8\Collections\PaginatedCollection;
use Mvdgeijn\Pax8\Responses\Subscription;

class SubscriptionRequest extends AbstractRequest
{
    /**
     * Returns a paginated list of all your subscriptions filtered by optional parameters
     *
     * Check for possible options
     *
     * @link https://docs.pax8.com/api/v1#tag/Subscriptions
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
     * Returns a single subscription record matching the subscriptionId you specify
     *
     * @param string $subscriptionId
     * @return Subscription|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $subscriptionId ): ?Subscription
    {
        $response = $this->getRequest('/v1/subscriptions/' . $subscriptionId );

        if ($response->getStatusCode() == 200) {
            return Subscription::parse(json_decode($response->getBody()));
        } else {
            return null;
        }
    }

    /**
     * @param string $subscriptionId
     * @param int $quantity
     * @return Subscription|null
     * @throws GuzzleException
     */
    public function update(string $subscriptionId, int $quantity ): ?Subscription
    {
        $data = new \stdClass();
        $data->quantity = $quantity;
        $data->startdate = date("Y-m-d");
        $data->billingTerm = "Monthly";

        $response = $this->putRequest('/v1/subscriptions/' . $subscriptionId, $data );

        if ($response->getStatusCode() == 200)
            return Subscription::parse(json_decode( $response->getBody() ) );
        else
            return null;
    }

    /**
     * @param string $subscriptionId
     * @param ?string $cancelDate
     * @return bool
     * @throws GuzzleException
     */
    public function delete(string $subscriptionId, ?string $cancelDate ): bool
    {
        $query = "";
        if( $cancelDate != null ) {
            $query = "?cancelData=" . $cancelDate;
        }

        $response = $this->deleteRequest( '/v1/subscriptions/' . $subscriptionId . $query, null );

        if( $response->getStatusCode() == 204 ) {
            return true;
        }

        return false;
    }
}
