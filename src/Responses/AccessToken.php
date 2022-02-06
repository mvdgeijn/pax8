<?php

namespace Mvdgeijn\Pax8\Responses;

use Mvdgeijn\Pax8\Requests\CompanyRequest;
use Mvdgeijn\Pax8\Requests\ContactRequest;

class AccessToken
{
    public string $accessToken;

    public int $expiryTimestamp;

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

    public function companyRequest(): CompanyRequest
    {
        return new CompanyRequest($this);
    }

    public function contactRequest(): ContactRequest
    {
        return new ContactRequest($this);
    }

}
