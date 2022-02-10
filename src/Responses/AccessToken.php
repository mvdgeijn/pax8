<?php

namespace Mvdgeijn\Pax8\Responses;

use Mvdgeijn\Pax8\Requests\AccessTokenRequest;
use Mvdgeijn\Pax8\Requests\CompanyRequest;
use Mvdgeijn\Pax8\Requests\ContactRequest;
use Mvdgeijn\Pax8\Requests\InvoiceRequest;
use Mvdgeijn\Pax8\Requests\OrderRequest;
use Mvdgeijn\Pax8\Requests\ProductRequest;
use Mvdgeijn\Pax8\Requests\SubscriptionRequest;

class AccessToken
{
    public ?string $accessToken;

    public int $expiryTimestamp;

    public function __construct( ?string $accessToken = null, int $expiryTimestamp = 0 )
    {
        $this->accessToken = $accessToken;
        $this->expiryTimestamp = $expiryTimestamp;
    }

    public function isExpired(): bool
    {
        return time() > $this->expiryTimestamp;
    }

    public static function createFromBody( string $body): ?AccessToken
    {
        $json = json_decode( $body );

        if( isset( $json->access_token ) && isset( $json->expires_in ) )
        {
            $token = new AccessToken();

            $token->accessToken = $json->access_token;
            $token->expiryTimestamp = time() + $json->expires_in - 600;

            return $token;
        }

        return null;
    }

    public function renew( )
    {
        $request = new AccessTokenRequest;
        $newAccessToken = $request->getAccessToken( true );

        $this->accessToken = $newAccessToken->accessToken;
        $this->expiryTimestamp = $newAccessToken->expiryTimestamp;
    }

    public function companyRequest(): CompanyRequest
    {
        return new CompanyRequest($this);
    }

    public function contactRequest(): ContactRequest
    {
        return new ContactRequest($this);
    }

    public function subscriptionRequest(): SubscriptionRequest
    {
        return new SubscriptionRequest($this);
    }

    public function productRequest(): ProductRequest
    {
        return new ProductRequest($this);
    }

    public function orderRequest(): OrderRequest
    {
        return new OrderRequest($this);
    }

    public function invoiceRequest(): InvoiceRequest
    {
        return new InvoiceRequest($this);
    }
}
