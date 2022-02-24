<?php

namespace Mvdgeijn\Pax8;

use Illuminate\Support\Facades\Cache;
use Mvdgeijn\Pax8\Requests\AccessTokenRequest;
use Mvdgeijn\Pax8\Requests\CompanyRequest;
use Mvdgeijn\Pax8\Requests\ContactRequest;
use Mvdgeijn\Pax8\Requests\InvoiceRequest;
use Mvdgeijn\Pax8\Requests\OrderRequest;
use Mvdgeijn\Pax8\Requests\ProductRequest;
use Mvdgeijn\Pax8\Requests\SubscriptionRequest;

class Pax8
{
    private const CACHE_KEY = "PAX8_ACCESS_TOKEN";

    public ?string $accessToken;

    public int $expiryTimestamp;

    /**
     *
     */
    public function __construct( )
    {
        list( $this->accessToken, $this->expiryTimestamp ) = Cache::get( self::CACHE_KEY, [null, 0] );
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return time() > $this->expiryTimestamp;
    }

    /**
     * @param string $body
     * @return Pax8|null
     */
    public static function createFromBody(string $body): ?Pax8
    {
        $json = json_decode( $body );

        if( isset( $json->access_token ) && isset( $json->expires_in ) )
        {
            $token = new Pax8();

            $token->accessToken = $json->access_token;
            $token->expiryTimestamp = time() + $json->expires_in - 600;

            return $token;
        }

        return null;
    }

    /**
     * @return Pax8
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function renew( ): self
    {
        $request = new AccessTokenRequest;
        $newPax8 = $request->getAccessToken( true );

        $this->accessToken = $newPax8->accessToken;
        $this->expiryTimestamp = $newPax8->expiryTimestamp;

        Cache::set( self::CACHE_KEY, [$this->accessToken, $this->expiryTimestamp], 86400 );

        return $this;
    }

    /**
     * @return CompanyRequest
     */
    public function companyRequest(): CompanyRequest
    {
        return new CompanyRequest($this);
    }

    /**
     * @return ContactRequest
     */
    public function contactRequest(): ContactRequest
    {
        return new ContactRequest($this);
    }

    /**
     * @return SubscriptionRequest
     */
    public function subscriptionRequest(): SubscriptionRequest
    {
        return new SubscriptionRequest($this);
    }

    /**
     * @return ProductRequest
     */
    public function productRequest(): ProductRequest
    {
        return new ProductRequest($this);
    }

    /**
     * @return OrderRequest
     */
    public function orderRequest(): OrderRequest
    {
        return new OrderRequest($this);
    }

    /**
     * @return InvoiceRequest
     */
    public function invoiceRequest(): InvoiceRequest
    {
        return new InvoiceRequest($this);
    }
}
